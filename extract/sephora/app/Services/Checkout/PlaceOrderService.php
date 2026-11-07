<?php

namespace App\Services\Checkout;

use App\Events\OrderPlaced;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponRedemption;
use App\Models\Order;
use App\Models\Product;
use App\Services\Commerce\OrderTotals;
use App\Services\Commerce\ShippingCalculator;
use App\Support\CommerceSettings;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;

class PlaceOrderService
{
    public function __construct(
        private readonly ShippingCalculator $shipping,
    ) {}

    /**
     * Place an order from the current cart inside a single database
     * transaction. Guarantees:
     *  - idempotent retries (same key returns the same order)
     *  - atomic stock decrement (no overselling under concurrency)
     *  - atomic coupon redemption (usage_limit / per_user_limit respected)
     *  - VAT breakdown computed from the gross (tax-inclusive) total
     *  - collision-safe order numbers
     *  - all-or-nothing writes (order + items + address + loyalty + cart)
     *
     * @param  array  $validated  Validated checkout input (CheckoutRequest->validated())
     *
     * @throws InsufficientStockException
     */
    public function place(Cart $cart, array $validated): Order
    {
        $cart->loadMissing('items.product.brand', 'items.product.images');

        if ($cart->items->isEmpty()) {
            throw new InvalidArgumentException('Cart is empty.');
        }

        $idempotencyKey = $validated['idempotency_key'] ?? null;

        if ($idempotencyKey) {
            $existing = Order::query()->where('idempotency_key', $idempotencyKey)->first();
            if ($existing) {
                return $existing;
            }
        }

        try {
            $order = DB::transaction(function () use ($cart, $validated, $idempotencyKey) {
                $deliveryMethod = $validated['delivery_method'];
                $paymentMethod = $validated['payment_method'];
                $subtotal = $cart->subtotal();

                // ── Coupon (atomic redemption) ─────────────────────────
                $coupon = $this->resolveCoupon($subtotal, $validated);
                $discount = $coupon ? $coupon->discountFor($subtotal) : 0.0;

                if ($coupon && ! $this->redeemCoupon($coupon)) {
                    $coupon = null;
                    $discount = 0.0;
                }

                // ── Delivery + VAT ────────────────────────────────────
                $shippingFee = $this->shipping->fee(
                    $deliveryMethod,
                    max(0, $subtotal - $discount),
                    $paymentMethod,
                );
                $totals = OrderTotals::calculate($subtotal, $discount, $shippingFee);

                // ── Stock (atomic decrement, no overselling) ───────────
                $this->decrementStock($cart);

                // ── Order ─────────────────────────────────────────────
                $order = Order::create([
                    'order_number' => $this->uniqueOrderNumber(),
                    'user_id' => auth()->id(),
                    'guest_email' => auth()->check() ? null : ($validated['customer_email'] ?? null),
                    'status' => $paymentMethod === 'cod' ? 'processing' : 'pending',
                    'payment_method' => $paymentMethod,
                    'payment_status' => 'pending',
                    'delivery_method' => $deliveryMethod,
                    'customer_name' => $validated['customer_name'],
                    'customer_phone' => $validated['customer_phone'],
                    'customer_email' => $validated['customer_email'] ?? auth()->user()?->email,
                    'emirate' => $validated['emirate'] ?? null,
                    'area' => $validated['area'] ?? null,
                    'shipping_address' => $this->shippingAddress($validated),
                    'delivery_instructions' => $validated['delivery_instructions'] ?? null,
                    'store_id' => $deliveryMethod === 'click_collect' ? ($validated['store_id'] ?? null) : null,
                    'tracking_number' => null,
                    'subtotal' => $totals->subtotal,
                    'subtotal_ex_tax' => $totals->subtotalExTax,
                    'tax_rate' => $totals->taxRate,
                    'tax_amount' => $totals->taxAmount,
                    'discount' => $totals->discount,
                    'shipping_fee' => $totals->shipping,
                    'coupon_code' => $coupon?->code,
                    'total' => $totals->total,
                    // Points accrue on merchandise spend only — never on
                    // delivery or cash-on-delivery fees.
                    'loyalty_points_earned' => CommerceSettings::loyaltyEnabled()
                        ? (int) floor(max(0, $totals->subtotal - $totals->discount))
                        : 0,
                    'samples' => $this->sanitizeSamples($validated['samples'] ?? []),
                    'gift_message' => $validated['gift_message'] ?? null,
                    'gift_box' => (bool) ($validated['gift_box'] ?? false),
                    'idempotency_key' => $idempotencyKey,
                    'placed_at' => now(),
                ]);

                foreach ($cart->items as $item) {
                    $order->items()->create([
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'brand_name' => $item->product->brand?->name,
                        'shade_name' => $item->shade_name,
                        'image_path' => $item->product->images->first()?->path,
                        'unit_price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'line_total' => $item->product->price * $item->quantity,
                    ]);
                }

                if ($coupon) {
                    CouponRedemption::create([
                        'coupon_id' => $coupon->id,
                        'user_id' => auth()->id(),
                        'order_id' => $order->id,
                        'email' => $order->customer_email,
                        'amount' => $totals->discount,
                    ]);
                }

                // ── Loyalty points ────────────────────────────────────
                if (auth()->check()) {
                    auth()->user()->increment('loyalty_points', $order->loyalty_points_earned);
                }

                // ── Persist the delivery address when requested ───────
                if (auth()->check()
                    && $deliveryMethod !== 'click_collect'
                    && (bool) ($validated['save_address'] ?? false)) {
                    $this->saveAddress($validated);
                }

                // ── Clear the cart + applied coupon ───────────────────
                $cart->items()->delete();
                Session::forget('coupon_code');

                return $order;
            });
        } catch (QueryException $e) {
            // A concurrent duplicate request may have won the idempotency
            // unique index race. Return the winner instead of failing.
            if ($idempotencyKey) {
                $existing = Order::query()->where('idempotency_key', $idempotencyKey)->first();
                if ($existing) {
                    return $existing;
                }
            }

            throw $e;
        }

        OrderPlaced::dispatch($order);

        return $order;
    }

    /**
     * Resolve a valid coupon for this bag and customer, or null.
     */
    private function resolveCoupon(float $subtotal, array $validated): ?Coupon
    {
        $code = strtoupper(trim((string) ($validated['coupon_code'] ?? Session::get('coupon_code', ''))));

        if ($code === '') {
            return null;
        }

        $coupon = Coupon::query()->where('code', $code)->lockForUpdate()->first();

        if (! $coupon) {
            return null;
        }

        $user = auth()->user();

        return $coupon->isValid($subtotal, $user, $validated['customer_email'] ?? null) ? $coupon : null;
    }

    /**
     * Increment used_count only while a usage limit still has room.
     */
    private function redeemCoupon(Coupon $coupon): bool
    {
        $redeemed = Coupon::query()
            ->whereKey($coupon->id)
            ->where('is_active', true)
            ->when(
                $coupon->usage_limit !== null,
                fn ($query) => $query->whereColumn('used_count', '<', 'usage_limit'),
            )
            ->update(['used_count' => DB::raw('used_count + 1')]);

        return $redeemed > 0;
    }

    /**
     * Atomically decrement stock. Throws before any order row is written
     * when an item is no longer available.
     */
    private function decrementStock(Cart $cart): void
    {
        foreach ($cart->items as $item) {
            $decremented = Product::query()
                ->whereKey($item->product_id)
                ->where('is_active', true)
                ->where('stock', '>=', $item->quantity)
                ->update(['stock' => DB::raw('stock - '.$item->quantity)]);

            if ($decremented === 0) {
                throw new InsufficientStockException(
                    $item->product?->name ?? "Product #{$item->product_id}"
                );
            }
        }
    }

    private function shippingAddress(array $validated): string
    {
        if (($validated['delivery_method'] ?? null) === 'click_collect') {
            return 'Store pickup: '.($validated['store_id'] ?? '');
        }

        return trim(implode(', ', array_filter([
            $validated['building'] ?? null,
            $validated['street_address'] ?? null,
            $validated['area'] ?? null,
            $validated['emirate'] ?? null,
        ])));
    }

    private function saveAddress(array $validated): void
    {
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $payload = [
            'label' => 'Checkout',
            'full_name' => $validated['customer_name'],
            'phone' => $validated['customer_phone'],
            'emirate' => $validated['emirate'],
            'area' => $validated['area'] ?? null,
            'street_address' => $validated['street_address'],
            'building' => $validated['building'] ?? null,
            'delivery_instructions' => $validated['delivery_instructions'] ?? null,
        ];

        if (! $user->addresses()->exists()) {
            $payload['is_default'] = true;
        }

        Address::create($payload + ['user_id' => $user->id]);
    }

    /**
     * Collision-safe order number: AE-yymmdd-XXXXXX with retry on the
     * unique constraint (6 hex chars ≈ 16M combinations per day).
     */
    private function uniqueOrderNumber(): string
    {
        $prefix = 'AE-'.now()->format('ymd').'-';

        for ($attempt = 0; $attempt < 8; $attempt++) {
            $candidate = $prefix.strtoupper(bin2hex(random_bytes(3)));
            if (! Order::where('order_number', $candidate)->exists()) {
                return $candidate;
            }
        }

        // Practically unreachable; fall back to a wider random space.
        return $prefix.strtoupper(bin2hex(random_bytes(5)));
    }

    /**
     * Keep only known sample product ids (integers that exist and are active).
     */
    private function sanitizeSamples(array $samples): array
    {
        $ids = array_values(array_unique(array_filter(array_map(
            fn ($v) => filter_var($v, FILTER_VALIDATE_INT),
            $samples
        ))));

        if ($ids === []) {
            return [];
        }

        return Product::active()->whereKey($ids)->pluck('id')->map(fn ($id) => (string) $id)->all();
    }
}
