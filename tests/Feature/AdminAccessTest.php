<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin@sephora.test',
        ]);
    }

    public function test_guest_cannot_access_admin(): void
    {
        $this->get('/admin')->assertRedirect('/sign-in');
    }

    public function test_regular_user_gets_403_on_admin(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin')->assertStatus(403);
        $this->actingAs($user)->get('/admin/products')->assertStatus(403);
        $this->actingAs($user)->get('/admin/orders')->assertStatus(403);
    }

    public function test_admin_can_view_dashboard(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin')
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    public function test_admin_can_create_product(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Admin Created Serum',
            'price' => 220,
            'stock' => 15,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.products'));
        $this->assertDatabaseHas('products', [
            'name' => 'Admin Created Serum',
            'price' => 220,
            'stock' => 15,
        ]);
    }

    public function test_admin_product_update_does_not_duplicate_images(): void
    {
        $product = $this->makeProduct();
        $product->images()->create([
            'path' => 'images/products/product_001.webp',
            'alt' => $product->name,
            'sort_order' => 0,
        ]);

        // Save the SAME image path twice — must not stack duplicates.
        foreach ([1, 2] as $i) {
            $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
                'name' => $product->name,
                'price' => 120,
                'stock' => 10,
                'image_path' => 'images/products/product_001.webp',
            ]);
        }

        $this->assertEquals(
            1,
            $product->fresh()->images()->where('path', 'images/products/product_001.webp')->count(),
            'Saving twice must not create duplicate image rows'
        );
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::create([
            'order_number' => 'AE-TEST-00001',
            'status' => 'processing',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Test',
            'customer_phone' => '+971500000000',
            'subtotal' => 100,
            'total' => 125,
        ]);

        $this->actingAs($this->admin)
            ->patch("/admin/orders/{$order->id}/status", [
                'status' => 'shipped',
                'payment_status' => 'paid',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped',
            'payment_status' => 'paid',
        ]);
    }

    public function test_order_status_validated(): void
    {
        $order = Order::create([
            'order_number' => 'AE-TEST-00002',
            'customer_name' => 'Test',
            'customer_phone' => '+971500000000',
            'subtotal' => 100,
            'total' => 125,
        ]);

        $this->actingAs($this->admin)
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'teleported'])
            ->assertSessionHasErrors('status');
    }
}
