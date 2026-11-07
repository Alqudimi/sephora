<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\PaymentWebhookEvent;
use App\Models\Product;
use App\Models\Store;
use App\Services\Checkout\InsufficientStockException;
use App\Services\Checkout\PlaceOrderService;
use App\Services\Commerce\ShippingCalculator;
use App\Services\Orders\OrderStateMachine;
use App\Services\Payments\PaymentManager;
use App\Services\Payments\WebhookProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use RuntimeException;

class CheckoutController extends Controller
{
    public function index(ShippingCalculator $shipping)
    {
        $cart = Cart::current()->loadMissing('items.product.images', 'items.product.brand');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart')->with('cart_empty', true);
        }

        $samples = Product::active()
            ->where('stock', '>', 0)
            ->where('price', '<', 60)
            ->with(['images'])
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $addresses = auth()->check() ? auth()->user()->addresses : collect();
        $defaultAddress = $addresses->firstWhere('is_default', true) ?? $addresses->first();

        $deliveryMethod = old('delivery_method', 'standard');
        $paymentMethod = old('payment_method', $this->defaultPaymentMethod());

        $subtotal = $cart->subtotal();
        $discount = $this->sessionDiscount($subtotal);
        $totals = $cart->totals($deliveryMethod, $paymentMethod, $discount);

        return view('shop.checkout', [
            'cart' => $cart,
            'items' => $cart->items,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'appliedCoupon' => $discount > 0 ? Session::get('coupon_code') : null,
            'shippingFee' => $totals->shipping,
            'totals' => $totals,
            'samples' => $samples,
            'addresses' => $addresses,
            'defaultAddress' => $defaultAddress,
            'stores' => Store::active()->orderBy('sort_order')->orderBy('name')->get(),
            'deliveryMethods' => config('commerce.delivery_methods', []),
            'deliveryMethod' => $deliveryMethod,
            'paymentMethod' => $paymentMethod,
            'paymentMethods' => $this->enabledPaymentMethods(),
            'freeShippingThreshold' => $shipping->freeShippingThreshold(),
            'idempotencyKey' => (string) str()->uuid(),
        ]);
    }

    /**
     * Live order summary used by the checkout UI when the shopper changes
     * delivery or payment method. All money is recomputed server-side.
     */
    public function summary(Request $request, ShippingCalculator $shipping)
    {
        $validated = $request->validate([
            'delivery_method' => ['required', 'string', 'in:'.implode(',', array_keys(config('commerce.delivery_methods', [])))],
            'payment_method' => ['nullable', 'string', 'in:'.implode(',', array_keys($this->enabledPaymentMethods()))],
        ]);

        $cart = Cart::current();
        $subtotal = $cart->subtotal();
        $discount = $this->sessionDiscount($subtotal);
        $totals = $cart->totals(
            $validated['delivery_method'],
            $validated['payment_method'] ?? $this->defaultPaymentMethod(),
            $discount,
        );

        return response()->json([
            'success' => true,
            'subtotal' => round($totals->subtotal, 2),
            'discount' => round($totals->discount, 2),
            'shipping' => round($totals->shipping, 2),
            'tax' => round($totals->taxAmount, 2),
            'tax_rate' => $totals->taxRate,
            'total' => round($totals->total, 2),
            'free_shipping_threshold' => $shipping->freeShippingThreshold(),
            'formatted' => [
                'subtotal' => $this->money($totals->subtotal),
                'discount' => $this->money($totals->discount),
                'shipping' => $totals->shipping <= 0 ? 'FREE' : $this->money($totals->shipping),
                'tax' => $this->money($totals->taxAmount),
                'total' => $this->money($totals->total),
            ],
        ]);
    }

    public function placeOrder(
        CheckoutRequest $request,
        PlaceOrderService $service,
        PaymentManager $payments,
        OrderStateMachine $states,
    ) {
        $cart = Cart::current();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart');
        }

        try {
            $order = $service->place($cart, $request->validated());
        } catch (InsufficientStockException $e) {
            return redirect()->route('cart')
                ->withErrors(['stock' => "Unfortunately, {$e->productName} just sold out. Please review your bag."]);
        }

        // Guests may reach their confirmation page from this session only.
        Session::put('placed_orders.'.$order->order_number, true);

        return $this->startPayment($order, $payments, $states);
    }

    /**
     * Returning from a hosted payment page. The provider is asked for the
     * authoritative status; the query string is never trusted.
     */
    public function paymentReturn(string $order, PaymentManager $payments, OrderStateMachine $states)
    {
        $orderModel = $this->findOrderForViewer($order);

        if ($orderModel->payment_status === 'paid') {
            return redirect()->route('checkout.confirmation', ['order' => $orderModel->order_number]);
        }

        try {
            $result = $payments->confirm($orderModel);
        } catch (RuntimeException $e) {
            Log::error('Payment confirmation failed.', ['order' => $orderModel->order_number, 'error' => $e->getMessage()]);

            return redirect()->route('checkout.confirmation', ['order' => $orderModel->order_number])
                ->with('payment_error', 'We could not confirm your payment yet. If you were charged, contact client concierge.');
        }

        if ($result->paid) {
            $states->markPaid($orderModel, $result->gateway ?? 'unknown', $result->reference, $result->payload);

            return redirect()->route('checkout.confirmation', ['order' => $orderModel->order_number])
                ->with('order_success', true);
        }

        return redirect()->route('checkout.confirmation', ['order' => $orderModel->order_number])
            ->with('payment_error', 'Your payment was not completed. You can retry payment below.');
    }

    /**
     * Retry an unfinished online payment for an order the viewer owns.
     */
    public function retryPayment(
        string $order,
        PaymentManager $payments,
        OrderStateMachine $states,
    ) {
        $orderModel = $this->findOrderForViewer($order);

        if ($orderModel->payment_status === 'paid') {
            return redirect()->route('checkout.confirmation', ['order' => $orderModel->order_number]);
        }

        if (! in_array($orderModel->payment_method, ['card', 'apple_pay'], true)) {
            return redirect()->route('checkout.confirmation', ['order' => $orderModel->order_number])
                ->with('payment_error', 'This order does not support online payment retry.');
        }

        return $this->startPayment($orderModel, $payments, $states);
    }

    /**
     * Provider webhook. Idempotent by (gateway, event id).
     */
    public function webhook(
        Request $request,
        string $gateway,
        PaymentManager $payments,
        OrderStateMachine $states,
    ) {
        $event = $payments->verifyWebhook($gateway, $request);

        if (! $event) {
            return response()->json(['ok' => false], 400);
        }

        $eventId = (string) ($event['id'] ?? hash('sha256', $request->getContent()));

        $record = PaymentWebhookEvent::firstOrCreate(
            ['gateway' => $gateway, 'event_id' => $eventId],
            ['type' => $event['type'] ?? null, 'payload' => $event],
        );

        $result = app(WebhookProcessor::class)->process($record);

        return response()->json([
            'ok' => $result['ok'],
            'duplicate' => $result['duplicate'],
        ]);
    }

    public function confirmation(Request $request, string $orderNumber)
    {
        $order = Order::with('items')
            ->where('order_number', $orderNumber)
            ->when(auth()->check(), fn ($q) => $q->where('user_id', auth()->id()))
            ->firstOrFail();

        // Guests may only view an order from the session that placed it,
        // or through the signed link e-mailed to them.
        if (! auth()->check()
            && ! Session::get("placed_orders.{$orderNumber}")
            && ! $request->hasValidSignature()) {
            abort(404);
        }

        return view('shop.confirmation', ['order' => $order]);
    }

    /**
     * Signed guest link target (e-mailed after checkout).
     */
    public function confirmationGuest(Request $request, string $order)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'This link has expired. Please contact client concierge.');
        }

        $orderModel = Order::with('items')->where('order_number', $order)->firstOrFail();

        return view('shop.confirmation', ['order' => $orderModel]);
    }

    /**
     * Apply a promo code to the session (validated against current subtotal).
     */
    public function applyCoupon(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:30'],
        ]);

        $code = strtoupper(trim($validated['code']));
        $cart = Cart::current();
        $subtotal = $cart->subtotal();

        if ($subtotal <= 0) {
            return response()->json(['success' => false, 'message' => 'Your bag is empty.'], 422);
        }

        $coupon = Coupon::where('code', $code)->first();

        if (! $coupon || ! $coupon->isValid($subtotal, auth()->user(), $request->user()?->email)) {
            return response()->json(['success' => false, 'message' => 'This code is not valid for your bag.'], 422);
        }

        Session::put('coupon_code', $code);
        $discount = $coupon->discountFor($subtotal);
        $totals = $cart->totals(
            (string) $request->input('delivery_method', 'standard'),
            $request->input('payment_method'),
            $discount,
        );

        return response()->json([
            'success' => true,
            'code' => $code,
            'discount' => round($discount, 2),
            'subtotal' => round($totals->subtotal, 2),
            'shipping' => round($totals->shipping, 2),
            'tax' => round($totals->taxAmount, 2),
            'total' => round($totals->total, 2),
            'formatted' => [
                'discount' => $this->money($discount),
                'subtotal' => $this->money($totals->subtotal),
                'shipping' => $totals->shipping <= 0 ? 'FREE' : $this->money($totals->shipping),
                'tax' => $this->money($totals->taxAmount),
                'total' => $this->money($totals->total),
            ],
            'message' => 'Promo code applied.',
        ]);
    }

    /**
     * Remove the applied promo code.
     */
    public function removeCoupon(Request $request)
    {
        Session::forget('coupon_code');
        $cart = Cart::current();
        $totals = $cart->totals(
            (string) $request->input('delivery_method', 'standard'),
            $request->input('payment_method'),
        );

        return response()->json([
            'success' => true,
            'subtotal' => round($totals->subtotal, 2),
            'shipping' => round($totals->shipping, 2),
            'tax' => round($totals->taxAmount, 2),
            'total' => round($totals->total, 2),
            'formatted' => [
                'discount' => $this->money(0),
                'subtotal' => $this->money($totals->subtotal),
                'shipping' => $totals->shipping <= 0 ? 'FREE' : $this->money($totals->shipping),
                'tax' => $this->money($totals->taxAmount),
                'total' => $this->money($totals->total),
            ],
            'message' => 'Promo code removed.',
        ]);
    }

    /**
     * Kick off payment for an order and route the shopper appropriately.
     */
    private function startPayment(Order $order, PaymentManager $payments, OrderStateMachine $states)
    {
        // Cash on delivery needs no provider round-trip.
        if ($order->payment_method === 'cod') {
            return redirect()->route('checkout.confirmation', ['order' => $order->order_number])
                ->with('order_success', true);
        }

        try {
            $result = $payments->start($order);
        } catch (RuntimeException $e) {
            Log::error('Payment start failed.', ['order' => $order->order_number, 'error' => $e->getMessage()]);

            $states->markFailed($order, 'Payment provider unavailable: '.$e->getMessage());

            return redirect()->route('checkout.confirmation', ['order' => $order->order_number])
                ->with('payment_error', 'We could not start your payment. Please retry payment below or contact client concierge.');
        }

        if ($result->redirectUrl) {
            $order->forceFill([
                'payment_gateway' => $result->gateway,
                'payment_reference' => $result->reference,
            ])->save();

            return redirect()->away($result->redirectUrl);
        }

        if ($result->paid) {
            $states->markPaid($order, $result->gateway ?? 'unknown', $result->reference, $result->payload);

            return redirect()->route('checkout.confirmation', ['order' => $order->order_number])
                ->with('order_success', true);
        }

        $order->forceFill([
            'payment_gateway' => $result->gateway,
            'payment_reference' => $result->reference,
        ])->save();

        return redirect()->route('checkout.confirmation', ['order' => $order->order_number]);
    }

    /**
     * Orders viewable by the current viewer (authenticated owner or the
     * guest session that placed them).
     */
    private function findOrderForViewer(string $orderNumber): Order
    {
        $order = Order::query()->where('order_number', $orderNumber)->firstOrFail();

        if (auth()->check() && $order->user_id === auth()->id()) {
            return $order;
        }

        if (! auth()->check() && Session::get("placed_orders.{$orderNumber}")) {
            return $order;
        }

        abort(404);
    }

    /**
     * Discount currently attached to the session (0 when invalid).
     */
    private function sessionDiscount(float $subtotal): float
    {
        $code = Session::get('coupon_code');
        if (! $code) {
            return 0.0;
        }

        $coupon = Coupon::where('code', $code)->first();

        return ($coupon && $coupon->isValid($subtotal, auth()->user())) ? $coupon->discountFor($subtotal) : 0.0;
    }

    private function defaultPaymentMethod(): string
    {
        $methods = array_keys($this->enabledPaymentMethods());

        return in_array('card', $methods, true) ? 'card' : ($methods[0] ?? 'cod');
    }

    /**
     * @return array<string, string>
     */
    private function enabledPaymentMethods(): array
    {
        $enabled = app(PaymentManager::class)->enabledMethods();

        $labels = [];
        foreach ($enabled as $method) {
            $labels[$method] = (string) config("payments.methods.{$method}.label", ucfirst($method));
        }

        return $labels;
    }

    private function money(float $amount): string
    {
        return 'AED '.number_format($amount, 2);
    }
}
