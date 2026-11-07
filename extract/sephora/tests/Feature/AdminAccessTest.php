<?php

namespace Tests\Feature;

use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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
            'role' => 'admin',
            'email' => 'admin@sephora.test',
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function test_guest_cannot_access_admin(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/products')->assertRedirect('/admin/login');
    }

    public function test_regular_user_gets_403_on_admin(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

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
        $this->actingAs($this->admin);

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => 'Admin Created Serum',
                'slug' => 'admin-created-serum',
                'description' => 'A potent nightly serum.',
                'price' => 220,
                'stock' => 15,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

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

        $this->actingAs($this->admin);

        // Save the SAME form twice — the main form must never stack
        // duplicate image rows.
        foreach ([1, 2] as $i) {
            Livewire::test(EditProduct::class, ['record' => $product->id])
                ->fillForm([
                    'name' => $product->name,
                    'description' => 'A potent nightly serum.',
                    'price' => 120,
                    'stock' => 10,
                ])
                ->call('save')
                ->assertHasNoFormErrors();
        }

        $this->assertEquals(
            1,
            $product->fresh()->images()->where('path', 'images/products/product_001.webp')->count(),
            'Saving twice must not create duplicate image rows'
        );
    }

    public function test_admin_product_create_form_renders(): void
    {
        $category = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $this->actingAs($this->admin)
            ->get('/admin/products/create')
            ->assertOk()
            ->assertSee('Name')
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
            ->assertSee('Apply three drops before bed.');
    }

    public function test_admin_can_create_product_with_catalog_fields_and_categories(): void
    {
        $category = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $this->actingAs($this->admin);

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => 'Velvet Night Serum',
                'slug' => 'velvet-night-serum',
                'description' => 'A nightly renewing serum.',
                'price' => 275.50,
                'compare_at_price' => 320,
                'stock' => 25,
                'sku' => 'VNS-001',
                'size' => '30ml',
                'badge' => 'NEW',
                'how_to_use' => 'Apply three drops before bed.',
                'ingredients' => 'Aqua, niacinamide, glycerin.',
                'meta_title' => 'Velvet Night Serum | SEPHORA UAE',
                'meta_description' => 'Shop the Velvet Night Serum at SEPHORA UAE.',
                'sort_order' => 7,
                'is_active' => true,
                'is_new' => true,
                'categories' => [$category->id],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $product = Product::where('name', 'Velvet Night Serum')->firstOrFail();

        $this->assertEquals('velvet-night-serum', $product->slug);
        $this->assertEquals('VNS-001', $product->sku);
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

    public function test_admin_update_clears_categories_when_none_selected(): void
    {
        $product = $this->makeProduct();

        $this->assertDatabaseCount('category_product', 1);

        $this->actingAs($this->admin);

        Livewire::test(EditProduct::class, ['record' => $product->id])
            ->fillForm([
                'name' => $product->name,
                'description' => 'A potent nightly serum.',
                'price' => 120,
                'stock' => 10,
                'is_active' => true,
                'categories' => [],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseCount('category_product', 0);
    }

    public function test_admin_update_syncs_newly_selected_categories(): void
    {
        $product = $this->makeProduct();
        $category = Category::firstOrCreate(['slug' => 'skincare'], ['name' => 'Skincare']);

        $this->actingAs($this->admin);

        Livewire::test(EditProduct::class, ['record' => $product->id])
            ->fillForm([
                'name' => $product->name,
                'description' => 'A potent nightly serum.',
                'price' => 150,
                'stock' => 12,
                'is_active' => true,
                'categories' => [$category->id],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('category_product', [
            'product_id' => $product->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_admin_product_search_matches_sku_and_visibility_filter(): void
    {
        $visible = $this->makeProduct(['name' => 'Hydrating Serum', 'sku' => 'HS-100']);
        $hidden = $this->makeProduct(['name' => 'Hidden Powder', 'sku' => 'HP-200', 'is_active' => false]);

        $this->actingAs($this->admin);

        Livewire::test(ListProducts::class)
            ->searchTable('HS-100')
            ->assertCanSeeTableRecords(collect([$visible]))
            ->assertCanNotSeeTableRecords(collect([$hidden]));

        Livewire::test(ListProducts::class)
            ->filterTable('is_active', false)
            ->assertCanSeeTableRecords(collect([$hidden]))
            ->assertCanNotSeeTableRecords(collect([$visible]));
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
