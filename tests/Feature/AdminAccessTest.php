<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
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
            'two_factor_confirmed_at' => now(),
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

    public function test_admin_product_create_form_renders(): void
    {
        $category = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $this->actingAs($this->admin)
            ->get('/admin/products/create')
            ->assertOk()
            ->assertSee('Add New Product')
            ->assertSee('Categories')
            ->assertSee('Meta title')
            ->assertSee($category->name);
    }

    public function test_admin_product_edit_form_renders(): void
    {
        $product = $this->makeProduct([
            'how_to_use' => 'Apply three drops before bed.',
        ]);

        $this->actingAs($this->admin)
            ->get("/admin/products/{$product->id}/edit")
            ->assertOk()
            ->assertSee($product->name)
            ->assertSee('Save changes')
            ->assertSee('Apply three drops before bed.');
    }

    public function test_admin_can_create_product_with_catalog_fields_and_categories(): void
    {
        $category = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Velvet Night Serum',
            'price' => 275.50,
            'compare_at_price' => 320,
            'stock' => 25,
            'sku' => 'VNS-001',
            'type' => 'Serum',
            'size' => '30ml',
            'badge' => 'New',
            'description' => 'A nightly renewing serum.',
            'how_to_use' => 'Apply three drops before bed.',
            'ingredients' => 'Aqua, niacinamide, glycerin.',
            'meta_title' => 'Velvet Night Serum | SEPHORA UAE',
            'meta_description' => 'Shop the Velvet Night Serum at SEPHORA UAE.',
            'sort_order' => 7,
            'is_active' => 1,
            'is_new' => 1,
            'categories' => [$category->id],
            'categories_present' => 1,
        ])->assertRedirect(route('admin.products'));

        $product = Product::where('name', 'Velvet Night Serum')->firstOrFail();

        $this->assertEquals('velvet-night-serum', $product->slug);
        $this->assertEquals('VNS-001', $product->sku);
        $this->assertEquals('Serum', $product->type);
        $this->assertEquals('30ml', $product->size);
        $this->assertEquals('Apply three drops before bed.', $product->how_to_use);
        $this->assertEquals('Aqua, niacinamide, glycerin.', $product->ingredients);
        $this->assertEquals('Velvet Night Serum | SEPHORA UAE', $product->meta_title);
        $this->assertEquals(320.0, (float) $product->compare_at_price);
        $this->assertEquals(7, $product->sort_order);
        $this->assertTrue($product->is_active);
        $this->assertTrue($product->is_new);
        $this->assertFalse($product->is_bestseller);

        $this->assertDatabaseHas('category_product', [
            'product_id' => $product->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_admin_update_clears_categories_when_marker_present_and_none_selected(): void
    {
        $product = $this->makeProduct();

        $this->assertDatabaseCount('category_product', 1);

        $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => $product->name,
            'price' => 120,
            'stock' => 10,
            'is_active' => 1,
            'categories_present' => 1,
        ])->assertRedirect(route('admin.products'));

        $this->assertDatabaseCount('category_product', 0);
    }

    public function test_admin_update_preserves_categories_when_marker_absent(): void
    {
        $product = $this->makeProduct();
        $categoryId = $product->categories()->firstOrFail()->id;

        $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => $product->name,
            'price' => 150,
            'stock' => 12,
            'is_active' => 1,
        ])->assertRedirect(route('admin.products'));

        $this->assertDatabaseHas('category_product', [
            'product_id' => $product->id,
            'category_id' => $categoryId,
        ]);
    }

    public function test_admin_product_search_matches_sku_and_status_filter(): void
    {
        $this->makeProduct(['name' => 'Hydrating Serum', 'sku' => 'HS-100']);
        $this->makeProduct(['name' => 'Hidden Powder', 'sku' => 'HP-200', 'is_active' => false]);

        $this->actingAs($this->admin)
            ->get('/admin/products?q=HS-100')
            ->assertOk()
            ->assertSee('Hydrating Serum')
            ->assertDontSee('Hidden Powder');

        $this->actingAs($this->admin)
            ->get('/admin/products?status=hidden')
            ->assertOk()
            ->assertSee('Hidden Powder')
            ->assertDontSee('Hydrating Serum');
    }

    public function test_admin_access_is_granted_by_role_not_only_boolean(): void
    {
        $roleAdmin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        $manager = User::factory()->create([
            'role' => 'manager',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($roleAdmin)->get('/admin')->assertOk();

        // Managers and support are staff and may enter the admin panel;
        // destructive abilities are gated by the Product/Order policies.
        $this->actingAs($manager)->get('/admin')->assertOk();
        $this->actingAs($manager)->get('/admin/orders')->assertOk();

        $support = User::factory()->create([
            'role' => 'support',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($support)->get('/admin')->assertOk();
        $this->actingAs($support)->get('/admin/orders')->assertOk();
    }

    public function test_admin_boolean_flag_still_grants_access(): void
    {
        $legacyAdmin = User::factory()->create([
            'role' => 'customer',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($legacyAdmin)
            ->get('/admin/products')
            ->assertOk();
    }
}
