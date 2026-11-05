<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPolicyTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private function staff(string $role): User
    {
        return User::factory()->create([
            'role' => $role,
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    private function makeOrder(string $status = 'pending'): Order
    {
        return Order::create([
            'order_number' => 'AE-POL-'.substr(uniqid(), -8),
            'status' => $status,
            'payment_method' => 'card',
            'payment_status' => $status === 'delivered' ? 'paid' : 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Policy Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'policy@example.com',
            'subtotal' => 100,
            'total' => 100,
        ]);
    }

    public function test_support_can_browse_products_but_cannot_change_them(): void
    {
        $support = $this->staff('support');
        $product = $this->makeProduct();

        $this->actingAs($support)->get('/admin/products')->assertOk();
        $this->actingAs($support)->get('/admin/products/create')->assertForbidden();
        $this->actingAs($support)->get("/admin/products/{$product->id}/edit")->assertForbidden();

        $this->actingAs($support)->post('/admin/products', [
            'name' => 'Support Created Serum',
            'price' => 120,
            'stock' => 5,
        ])->assertForbidden();

        $this->actingAs($support)->delete("/admin/products/{$product->id}")->assertForbidden();

        $this->assertDatabaseMissing('products', ['name' => 'Support Created Serum']);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_manager_can_manage_products(): void
    {
        $manager = $this->staff('manager');
        $product = $this->makeProduct();

        $this->actingAs($manager)->get('/admin/products/create')->assertOk();

        $this->actingAs($manager)->post('/admin/products', [
            'name' => 'Manager Created Serum',
            'price' => 150,
            'stock' => 8,
            'is_active' => true,
        ])->assertRedirect(route('admin.products'));

        $this->assertDatabaseHas('products', ['name' => 'Manager Created Serum']);

        $this->actingAs($manager)->put("/admin/products/{$product->id}", [
            'name' => 'Manager Updated Serum',
            'price' => 110,
            'stock' => 12,
        ])->assertRedirect(route('admin.products'));

        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Manager Updated Serum']);
    }

    public function test_support_can_update_order_status_but_cannot_refund(): void
    {
        $support = $this->staff('support');
        $order = $this->makeOrder();

        $this->actingAs($support)
            ->patch(route('admin.orders.status', $order), ['status' => 'processing'])
            ->assertSessionHasNoErrors();

        $this->assertSame('processing', $order->fresh()->status);

        $delivered = $this->makeOrder('delivered');

        $this->actingAs($support)
            ->patch(route('admin.orders.status', $delivered), [
                'status' => 'refunded',
                'refund_amount' => 100,
            ])
            ->assertForbidden();

        $delivered->refresh();

        $this->assertSame('delivered', $delivered->status);
        $this->assertSame('paid', $delivered->payment_status);
    }

    public function test_manager_can_refund_a_delivered_order(): void
    {
        $manager = $this->staff('manager');
        $order = $this->makeOrder('delivered');

        $this->actingAs($manager)
            ->patch(route('admin.orders.status', $order), [
                'status' => 'refunded',
                'refund_amount' => 100,
                'refund_reference' => 'rf_policy_1',
            ])
            ->assertSessionHasNoErrors();

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame('refunded', $order->payment_status);
        $this->assertSame(100.0, $order->refund_amount);
        $this->assertSame('rf_policy_1', $order->refund_reference);
    }

    public function test_role_admin_without_boolean_flag_can_refund(): void
    {
        $admin = $this->staff('admin');
        $order = $this->makeOrder('delivered');

        $this->actingAs($admin)
            ->patch(route('admin.orders.status', $order), ['status' => 'refunded'])
            ->assertSessionHasNoErrors();

        $this->assertSame('refunded', $order->fresh()->status);
    }

    public function test_boolean_admin_flag_grants_catalogue_management(): void
    {
        $legacyAdmin = User::factory()->create([
            'role' => 'customer',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($legacyAdmin)->get('/admin/products/create')->assertOk();

        $this->actingAs($legacyAdmin)->post('/admin/products', [
            'name' => 'Legacy Admin Serum',
            'price' => 99,
            'stock' => 3,
            'is_active' => true,
        ])->assertRedirect(route('admin.products'));

        $this->assertDatabaseHas('products', ['name' => 'Legacy Admin Serum']);
    }

    public function test_customer_cannot_enter_the_admin_panel(): void
    {
        $customer = User::factory()->create(['role' => 'customer', 'is_admin' => false]);

        $this->actingAs($customer)->get('/admin')->assertForbidden();
        $this->actingAs($customer)->get('/admin/orders')->assertForbidden();
    }
}
