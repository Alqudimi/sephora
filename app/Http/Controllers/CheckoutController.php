<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Services\Checkout\InsufficientStockException;
use App\Services\Checkout\PlaceOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::current()->loadMissing('items.product.images', 'items.product.brand');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart')->with('cart_empty', true);
        }

        $samples = Product::active()
            ->where('price', '<', 60)
            ->with(['images'])
            ->inRandomOrder(mt_srand(42)) // stable "curated" selection
            ->limit(3)
            ->get();

        $subtotal = $cart->subtotal();
        $discount = $this->sessionDiscount($subtotal);
        $addresses = auth()->check() ? auth()->user()->addresses : collect();

        return view('shop.checkout', [
            'cart' => $cart,
            'items' => $cart->items,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'appliedCoupon' => $discount > 0 ? Session::get('coupon_code') : null,
            'shippingFee' => $cart->shippingFee(),
            'total' => max(0, $subtotal - $discount) + $cart->shippingFee(),
            'samples' => $samples,
            'addresses' => $addresses,
            'defaultAddress' => $addresses->firstWhere('is_default', true) ?? $addresses->first(),
        ]);
    }

    public function placeOrder(CheckoutRequest $request, PlaceOrderService $service)
    {
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

        // Let the guest reach their confirmation page for this session only.
        Session::put('placed_orders.'.$order->order_number, true);

        return redirect()->route('checkout.confirmation', ['order' => $order->order_number])
            ->with('order_success', true);
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
            return response()->json(['success' => false, 'message' => 'Your bag is empty.']);
        }

        $coupon = Coupon::where('code', $code)->first();

        if (! $coupon || ! $coupon->isValid($subtotal)) {
            return response()->json(['success' => false, 'message' => 'This code is not valid for your bag.']);
        }

        Session::put('coupon_code', $code);
        $discount = $coupon->discountFor($subtotal);
        $total = max(0, $subtotal - $discount) + $cart->shippingFee();

        return response()->json([
            'success' => true,
            'code' => $code,
            'discount' => round($discount, 2),
            'subtotal' => round($subtotal, 2),
            'shipping' => round($cart->shippingFee(), 2),
            'total' => round($total, 2),
            'message' => 'Promo code applied.',
        ]);
    }

    /**
     * Remove the applied promo code.
     */
    public function removeCoupon()
    {
        Session::forget('coupon_code');
        $cart = Cart::current();
        $subtotal = $cart->subtotal();

        return response()->json([
            'success' => true,
            'subtotal' => round($subtotal, 2),
            'shipping' => round($cart->shippingFee(), 2),
            'total' => round($subtotal + $cart->shippingFee(), 2),
            'message' => 'Promo code removed.',
        ]);
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

        return ($coupon && $coupon->isValid($subtotal)) ? $coupon->discountFor($subtotal) : 0.0;
    }
}
