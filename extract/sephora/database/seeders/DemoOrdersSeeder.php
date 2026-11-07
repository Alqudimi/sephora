<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Generates realistic demo orders so the admin dashboard, reports and
 * charts have meaningful data out of the box. Safe to run repeatedly —
 * it only runs when the orders table is empty.
 */
class DemoOrdersSeeder extends Seeder
{
    public function run(): void
    {
        if (Order::query()->exists()) {
            return;
        }

        $products = Product::query()->where('is_active', true)->with('brand')->get();
        $stores = Store::query()->pluck('id');
        $demoUser = User::query()->where('email', 'demo@sephora.test')->first();

        if ($products->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'processing', 'shipped', 'out_for_delivery', 'delivered', 'delivered', 'delivered', 'cancelled', 'refunded'];
        $paymentMethods = ['card', 'card', 'apple_pay', 'tabby', 'tamara', 'cod'];
        $deliveryMethods = ['standard', 'standard', 'standard', 'same_day', 'click_collect'];
        $emirates = [
            ['emirate' => 'Dubai', 'area' => 'Downtown Dubai'],
            ['emirate' => 'Dubai', 'area' => 'Marina'],
            ['emirate' => 'Abu Dhabi', 'area' => 'Khalidiya'],
            ['emirate' => 'Sharjah', 'area' => 'Al Majaz'],
            ['emirate' => 'Dubai', 'area' => 'Jumeirah'],
        ];

        $seq = 0;

        // 45 orders spread across the last 60 days.
        for ($i = 0; $i < 45; $i++) {
            $daysAgo = random_int(0, 59);
            $placedAt = now()->subDays($daysAgo)->subHours(random_int(0, 20));
            $status = $daysAgo < 2 ? collect(['pending', 'processing', 'shipped'])->random() : $statuses[array_rand($statuses)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $deliveryMethod = $deliveryMethods[array_rand($deliveryMethods)];
            $location = $emirates[array_rand($emirates)];

            $itemCount = random_int(1, 4);
            $subtotal = 0.0;
            $items = [];

            for ($j = 0; $j < $itemCount; $j++) {
                $product = $products->random();
                $quantity = random_int(1, 3);
                $unitPrice = (float) $product->price;
                $lineTotal = round($unitPrice * $quantity, 2);
                $subtotal += $lineTotal;

                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ];
            }

            $subtotal = round($subtotal, 2);
            $discount = 0.0;
            $couponCode = null;

            // ~20% of orders used a coupon.
            if (random_int(1, 5) === 1) {
                $discount = round($subtotal * 0.1, 2);
                $couponCode = 'WELCOME10';
            }

            $shippingFee = match ($deliveryMethod) {
                'same_day' => 40.0,
                'click_collect' => 0.0,
                default => $subtotal >= 250 ? 0.0 : 25.0,
            };

            if ($paymentMethod === 'cod' && $deliveryMethod !== 'click_collect') {
                $shippingFee += 20.0;
            }

            $shippingFee = round($shippingFee, 2);
            $total = round($subtotal - $discount + $shippingFee, 2);
            $taxAmount = round($total - ($total / 1.05), 2);

            $isGuest = random_int(1, 3) === 1;
            $user = (! $isGuest && $demoUser) ? $demoUser : null;

            $orderNumber = sprintf(
                'AE-%s-%06d',
                $placedAt->format('ymd'),
                100000 + (++$seq * 37) % 900000
            );

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user?->id,
                'guest_email' => $isGuest ? 'guest'.random_int(100, 999).'@example.com' : null,
                'status' => $status,
                'payment_method' => $paymentMethod,
                'payment_status' => match ($status) {
                    'cancelled' => 'pending',
                    'refunded' => 'refunded',
                    default => collect(['paid', 'paid', 'paid', 'pending'])->random(),
                },
                'delivery_method' => $deliveryMethod,
                'customer_name' => $user?->name ?? collect(['Aisha Rahman', 'Fatima Al Zaabi', 'Layla Haddad', 'Sara Khalil', 'Mariam Al Suwaidi'])->random(),
                'customer_phone' => '+9715'.random_int(10000000, 59999999),
                'customer_email' => $user?->email ?? 'guest'.random_int(100, 999).'@example.com',
                'emirate' => $deliveryMethod === 'click_collect' ? null : $location['emirate'],
                'area' => $deliveryMethod === 'click_collect' ? null : $location['area'],
                'shipping_address' => $deliveryMethod === 'click_collect' ? null : random_int(1, 120).' '.collect(['Sheikh Zayed Road', 'Al Wasl Road', 'Reem Street', 'Corniche Road'])->random(),
                'delivery_instructions' => random_int(1, 4) === 1 ? 'Please call on arrival.' : null,
                'store_id' => $deliveryMethod === 'click_collect' ? ($stores->random() ?? null) : null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'coupon_code' => $couponCode,
                'shipping_fee' => $shippingFee,
                'tax_rate' => 0.05,
                'tax_amount' => $taxAmount,
                'subtotal_ex_tax' => round($total - $taxAmount, 2),
                'total' => $total,
                'loyalty_points_earned' => (int) floor($subtotal - $discount),
                'samples' => random_int(1, 3) === 1 ? [$products->random()->id] : [],
                'gift_box' => random_int(1, 6) === 1,
                'gift_message' => random_int(1, 8) === 1 ? 'Happy birthday! Enjoy this little treat.' : null,
                'placed_at' => $placedAt,
                'shipped_at' => in_array($status, ['shipped', 'out_for_delivery', 'delivered', 'refunded']) ? $placedAt->copy()->addHours(random_int(2, 24)) : null,
                'delivered_at' => $status === 'delivered' ? $placedAt->copy()->addHours(random_int(24, 72)) : null,
                'cancelled_at' => $status === 'cancelled' ? $placedAt->copy()->addHours(random_int(1, 10)) : null,
                'refunded_at' => $status === 'refunded' ? $placedAt->copy()->addDays(random_int(1, 5)) : null,
                'refund_amount' => $status === 'refunded' ? $total : null,
                'cancel_reason' => $status === 'cancelled' ? 'Customer changed their mind.' : null,
                'payment_gateway' => $paymentMethod === 'cod' ? null : 'fake',
                'payment_reference' => $paymentMethod === 'cod' ? null : 'pi_demo_'.random_int(10000, 99999),
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'brand_name' => $item['product']->brand?->name,
                    'shade_name' => $item['product']->shades()->exists() ? $item['product']->shades()->inRandomOrder()->first()?->name : null,
                    'image_path' => $item['product']->first_image,
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['line_total'],
                ]);
            }
        }

        $this->command?->info('DemoOrdersSeeder: created 45 demo orders.');
    }
}
