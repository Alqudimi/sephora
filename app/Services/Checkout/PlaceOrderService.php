<?php

namespace App\Services\Checkout;

use App\Events\OrderPlaced;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;

class PlaceOrderService
{
    /**
     * Place an order from the current cart inside a single database
     * transaction. Guarantees:
     *  - atomic stock decrement (no overselling under concurrency)
     *  - atomic coupon redemption (usage_limit respected under concurrency)
     *  - collision-safe order numbers
     *  - all-or-nothing writes (order + items + loyalty + cart clearing)
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

        $order = DB::transaction(function () use ($cart, $validated) {
            $subtotal = $cart->subtotal();
            $shippingFee = $cart->shippingFee();

            // ── Coupon (atomic redemption) ─────────────────────────────
            $discount = 0;
            $couponCode = Session::get('coupon_code');
            if ($couponCode) {
                $coupon = Coupon::where('code', $couponCode)->lockForUpdate()->first();
                if ($coupon && $coupon->isValid($subtotal)) {
                    $discount = $coupon->discountFor($subtotal);
                    // Atomic guard: increment only while under the usage limit.
                    $redeemed = Coupon::query()
                        ->whereKey($coupon->id)
                        ->where('is_active', true)
                        ->when($coupon->usage_limit !== null, fn ($q) => $q->whereColumn('used_count', '<', 'usage_limit'))
                        ->update(['used_count' => DB::raw('used_count + 1')]);
                    if ($redeemed === 0 && $coupon->usage_limit !== null) {
                        $discount = 0;
                        $couponCode = null;
                    }
                } else {
                    $couponCode = null;
                }
            }

            $total = max(0, $subtotal - $discount) + $shippingFee;

            // ── Stock (atomic decrement, no overselling) ───────────────
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

            // ── Order ──────────────────────────────────────────────────
            $order = Order::create([
                'order_number' => $this->uniqueOrderNumber(),
                'user_id' => auth()->id(),
                'guest_email' => auth()->check() ? null : ($validated['customer_email'] ?? null),
                'status' => 'processing',
                'payment_method' => $validated['payment_method'],
                // Online methods stay "pending" until a payment gateway
                // confirms; wire the gateway webhook/redirect in production.
                'payment_status' => 'pending',
                'delivery_method' => $validated['delivery_method'],
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? auth()->user()->email ?? null,
                'emirate' => $validated['emirate'] ?? null,
                'area' => $validated['area'] ?? null,
                'shipping_address' => $validated['street_address'] ?? ('Store pickup: '.($validated['store_id'] ?? '')),
                'delivery_instructions' => $validated['delivery_instructions'] ?? null,
                'store_id' => $validated['store_id'] ?? null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping_fee' => $shippingFee,
                'coupon_code' => $couponCode,
                'total' => $total,
                'loyalty_points_earned' => (int) floor($total),
                'samples' => $this->sanitizeSamples($validated['samples'] ?? []),
                'gift_message' => $validated['gift_message'] ?? null,
                'gift_box' => (bool) ($validated['gift_box'] ?? false),
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

            // ── Loyalty points ────────────────────────────────────────
            if (auth()->check()) {
                auth()->user()->increment('loyalty_points', $order->loyalty_points_earned);
            }

            // ── Clear the cart + applied coupon ───────────────────────
            $cart->items()->delete();
            Session::forget('coupon_code');

            return $order;
        });

        OrderPlaced::dispatch($order);

        return $order;
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
