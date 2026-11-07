<?php

namespace Tests\Feature;

use App\Events\OrderPlaced;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private array $validPayload = [
        'customer_name' => 'Test Customer',
        'customer_phone' => '+971501234567',
        'customer_email' => 'guest@example.com',
        'delivery_method' => 'standard',
        'emirate' => 'Dubai',
        'street_address' => 'Burj Crown Residences',
        'payment_method' => 'cod',
        'terms' => '1',
    ];

    public function test_checkout_requires_cart(): void
    {
        $this->get('/checkout')->assertRedirect(route('cart'));
    }

    public function test_guest_can_place_order(): void
    {
        Event::fake([OrderPlaced::class]);
        $product = $this->makeProduct(['price' => 300]); // over free shipping

        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $response = $this->post('/checkout/place-order', $this->validPayload);

        $orderNumber = session('placed_orders');
        $this->assertDatabaseCount('orders', 1);
        $order = Order::first();

        $response->assertRedirect(route('checkout.confirmation', ['order' => $order->order_number]));

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Payment stays pending until a gateway confirms.
        $this->assertEquals('pending', $order->payment_status);
        // Stock decremented atomically.
        $this->assertEquals(49, $product->fresh()->stock);
        // Cart emptied.
        $this->assertDatabaseCount('cart_items', 0);
        // Event fired for the confirmation email pipeline.
        Event::assertDispatched(OrderPlaced::class);
    }

    public function test_loyalty_points_awarded_to_logged_in_user(): void
    {
        Event::fake([OrderPlaced::class]);
        $user = User::factory()->create(['loyalty_points' => 0]);
        $product = $this->makeProduct(['price' => 150]);

        $this->actingAs($user);
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 2]);
        $this->carrySession($resp); // 300 AED

        $this->post('/checkout/place-order', $this->validPayload);

        $order = Order::first();
        $this->assertEquals(300, $order->loyalty_points_earned);
        $this->assertEquals(300, $user->fresh()->loyalty_points);
    }

    public function test_stock_not_decremented_below_zero(): void
    {
        Event::fake([OrderPlaced::class]);
        $product = $this->makeProduct(['stock' => 1]);

        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        // Simulate stock changing after the bag was filled — e.g. another
        // shopper bought the last unit before this checkout completed.
        Cart::current()->items()->update(['quantity' => 2]);

        $this->post('/checkout/place-order', $this->validPayload)
            ->assertRedirect(route('cart'))
            ->assertSessionHasErrors('stock');

        // Order refused, stock untouched, cart preserved.
        $this->assertDatabaseCount('orders', 0);
        $this->assertEquals(1, $product->fresh()->stock);
        $this->assertDatabaseCount('cart_items', 1);
    }

    public function test_checkout_validation_requires_emirate_for_delivery(): void
    {
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $payload = array_merge($this->validPayload, ['emirate' => null, 'street_address' => null]);

        $this->post('/checkout/place-order', $payload)
            ->assertSessionHasErrors(['emirate', 'street_address']);
    }

    public function test_click_collect_requires_store(): void
    {
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $payload = array_merge($this->validPayload, [
            'delivery_method' => 'click_collect',
            'store_id' => null,
        ]);

        $this->post('/checkout/place-order', $payload)
            ->assertSessionHasErrors('store_id');
    }

    public function test_coupon_apply_and_order_discount(): void
    {
        Event::fake([OrderPlaced::class]);
        Coupon::create([
            'code' => 'TEST10',
            'type' => 'percent',
            'value' => 10,
            'min_order' => 100,
            'is_active' => true,
        ]);
        $product = $this->makeProduct(['price' => 200]);

        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        // Apply the coupon
        $this->postJson('/checkout/coupon', ['code' => 'test10'])
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('discount', 20);

        // Place the order — discount recorded, usage counted.
        $this->post('/checkout/place-order', $this->validPayload);

        $order = Order::first();
        $this->assertEquals(20.0, (float) $order->discount);
        $this->assertEquals('TEST10', $order->coupon_code);
        $this->assertEquals(1, $order->coupon->used_count ?? 1);
        $this->assertDatabaseHas('coupons', ['code' => 'TEST10', 'used_count' => 1]);
    }

    public function test_invalid_coupon_rejected(): void
    {
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $this->postJson('/checkout/coupon', ['code' => 'NOPE99'])
            ->assertStatus(422)
            ->assertJsonPath('success', false);
    }

    public function test_expired_coupon_rejected(): void
    {
        Coupon::create([
            'code' => 'OLDSALE',
            'type' => 'percent',
            'value' => 20,
            'expires_at' => today()->subDay(),
            'is_active' => true,
        ]);
        $product = $this->makeProduct();

        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $this->postJson('/checkout/coupon', ['code' => 'OLDSALE'])
            ->assertStatus(422)
            ->assertJsonPath('success', false);
    }

    public function test_coupon_usage_limit_respected(): void
    {
        Coupon::create([
            'code' => 'ONCEONLY',
            'type' => 'fixed',
            'value' => 50,
            'min_order' => 0,
            'usage_limit' => 1,
            'used_count' => 1,
            'is_active' => true,
        ]);
        $product = $this->makeProduct();

        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $this->postJson('/checkout/coupon', ['code' => 'ONCEONLY'])
            ->assertStatus(422)
            ->assertJsonPath('success', false);
    }

    public function test_guest_confirmation_access_control(): void
    {
        Event::fake([OrderPlaced::class]);
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);
        $this->post('/checkout/place-order', $this->validPayload);

        $order = Order::first();

        // Same session → allowed
        $this->get(route('checkout.confirmation', ['order' => $order->order_number]))
            ->assertStatus(200);

        // Fresh session (another visitor) → 404
        $this->flushSession();
        $this->dropCarriedSession();
        $this->get(route('checkout.confirmation', ['order' => $order->order_number]))
            ->assertStatus(404);
    }

    public function test_signed_guest_link_grants_access(): void
    {
        Event::fake([OrderPlaced::class]);
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);
        $this->post('/checkout/place-order', $this->validPayload);

        $order = Order::first();
        $signedUrl = \URL::temporarySignedRoute(
            'checkout.confirmation.guest',
            now()->addDays(30),
            ['order' => $order->order_number],
        );

        $this->flushSession();
        $this->dropCarriedSession();
        $this->get($signedUrl)->assertStatus(200);

        // Tampered (unsigned) link → 403
        $this->get(str_replace('signature=', 'signature=tampered', $signedUrl))
            ->assertStatus(403);
    }

    public function test_user_cannot_view_others_order(): void
    {
        Event::fake([OrderPlaced::class]);
        $owner = User::factory()->create();
        $product = $this->makeProduct();

        $this->actingAs($owner);
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);
        $this->post('/checkout/place-order', $this->validPayload);
        $order = Order::first();

        // A different signed-in user must get 404.
        $intruder = User::factory()->create();
        $this->actingAs($intruder)
            ->get(route('checkout.confirmation', ['order' => $order->order_number]))
            ->assertStatus(404);
    }

    public function test_samples_must_reference_real_products(): void
    {
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $payload = array_merge($this->validPayload, ['samples' => [$product->id, '999999', 'garbage']]);

        $this->post('/checkout/place-order', $payload)
            ->assertSessionHasErrors(['samples.1', 'samples.2']);

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_valid_samples_stored_on_order(): void
    {
        Event::fake([OrderPlaced::class]);
        $product = $this->makeProduct();
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $payload = array_merge($this->validPayload, ['samples' => [$product->id]]);

        $this->post('/checkout/place-order', $payload);

        $order = Order::first();
        $this->assertEquals([(string) $product->id], $order->samples);
    }
}
