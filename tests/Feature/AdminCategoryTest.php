<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryTest extends TestCase
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

    public function test_guest_cannot_access_admin_categories(): void
    {
        $this->get('/admin/categories')->assertRedirect('/sign-in');
    }

    public function test_regular_user_cannot_access_admin_categories(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin/categories')->assertForbidden();
    }

    public function test_admin_can_create_category(): void
    {
        $parent = Category::create([
            'name' => 'Makeup',
            'slug' => 'makeup',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => 'Lipsticks',
            'parent_id' => $parent->id,
            'hero_title' => 'Bold lips',
            'hero_subtitle' => 'For every mood',
            'hero_image' => 'images/categories/lips.webp',
            'description' => 'All lipstick shades.',
            'is_active' => '1',
            'show_in_nav' => '1',
            'sort_order' => 12,
        ]);

        $response->assertRedirect(route('admin.categories'));

        $category = Category::where('name', 'Lipsticks')->firstOrFail();

        $this->assertSame('lipsticks', $category->slug);
        $this->assertSame($parent->id, $category->parent_id);
        $this->assertTrue($category->is_active);
        $this->assertTrue($category->show_in_nav);
        $this->assertSame(12, $category->sort_order);
        $this->assertSame('images/categories/lips.webp', $category->hero_image);
    }

    public function test_admin_can_update_category(): void
    {
        $category = Category::create([
            'name' => 'Skincare',
            'slug' => 'skincare',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/categories/{$category->id}", [
            'name' => 'Skin Care',
            'slug' => 'skin-care',
            'is_active' => '1',
            'show_in_nav' => '0',
            'sort_order' => 5,
        ]);

        $response->assertRedirect(route('admin.categories'));

        $category->refresh();

        $this->assertSame('Skin Care', $category->name);
        $this->assertSame('skin-care', $category->slug);
        $this->assertSame(5, $category->sort_order);
        $this->assertFalse($category->show_in_nav);
    }

    public function test_admin_can_delete_empty_category(): void
    {
        $category = Category::create([
            'name' => 'Empty Category',
            'slug' => 'empty-category',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/categories/{$category->id}");

        $response->assertRedirect(route('admin.categories'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_admin_cannot_delete_category_with_products(): void
    {
        $category = Category::create([
            'name' => 'Makeup',
            'slug' => 'makeup',
            'is_active' => true,
        ]);

        $product = $this->makeProduct();
        $product->categories()->sync([$category->id]);

        $response = $this->actingAs($this->admin)->delete("/admin/categories/{$category->id}");

        $response->assertRedirect(route('admin.categories'));
        $response->assertSessionHasErrors('category');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_category_slug_must_be_unique(): void
    {
        Category::create([
            'name' => 'Makeup',
            'slug' => 'makeup',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->post('/admin/categories', [
            'name' => 'Another Makeup',
            'slug' => 'makeup',
        ]);

        $response->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('categories', 1);
    }

    public function test_admin_category_form_renders(): void
    {
        $category = Category::create([
            'name' => 'Fragrance',
            'slug' => 'fragrance',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin)
            ->get("/admin/categories/{$category->id}/edit")
            ->assertOk()
            ->assertSee('Edit: Fragrance')
            ->assertSee('Save changes');
    }
}
