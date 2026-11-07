<?php

namespace Tests\Feature;

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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
            'role' => 'admin',
            'email' => 'admin@sephora.test',
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function test_guest_cannot_access_admin_categories(): void
    {
        $this->get('/admin/categories')->assertRedirect('/admin/login');
    }

    public function test_regular_user_cannot_access_admin_categories(): void
    {
        $user = User::factory()->create(['two_factor_confirmed_at' => now()]);

        $this->actingAs($user)->get('/admin/categories')->assertForbidden();
    }

    public function test_admin_can_create_category(): void
    {
        $parent = Category::create([
            'name' => 'Makeup',
            'slug' => 'makeup',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin);

        Livewire::test(CreateCategory::class)
            ->fillForm([
                'name' => 'Lipsticks',
                'slug' => 'lipsticks',
                'parent_id' => $parent->id,
                'hero_title' => 'Bold lips',
                'hero_subtitle' => 'For every mood',
                'description' => 'All lipstick shades.',
                'is_active' => true,
                'show_in_nav' => true,
                'sort_order' => 12,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $category = Category::where('name', 'Lipsticks')->firstOrFail();

        $this->assertSame('lipsticks', $category->slug);
        $this->assertSame($parent->id, $category->parent_id);
        $this->assertTrue($category->is_active);
        $this->assertTrue($category->show_in_nav);
        $this->assertSame(12, (int) $category->sort_order);
        $this->assertSame('Bold lips', $category->hero_title);
        $this->assertSame('For every mood', $category->hero_subtitle);
    }

    public function test_admin_can_update_category(): void
    {
        $category = Category::create([
            'name' => 'Skincare',
            'slug' => 'skincare',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin);

        Livewire::test(EditCategory::class, ['record' => $category->id])
            ->fillForm([
                'name' => 'Skin Care',
                'slug' => 'skin-care',
                'is_active' => true,
                'show_in_nav' => false,
                'sort_order' => 5,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $category->refresh();

        $this->assertSame('Skin Care', $category->name);
        $this->assertSame('skin-care', $category->slug);
        $this->assertSame(5, (int) $category->sort_order);
        $this->assertFalse($category->show_in_nav);
    }

    public function test_admin_can_delete_empty_category(): void
    {
        $category = Category::create([
            'name' => 'Empty Category',
            'slug' => 'empty-category',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin);

        Livewire::test(ListCategories::class)
            ->callAction(TestAction::make('delete')->table($category));

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

        $this->actingAs($this->admin);

        Livewire::test(ListCategories::class)
            ->callAction(TestAction::make('delete')->table($category))
            ->assertNotified('Category cannot be deleted');

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('category_product', [
            'product_id' => $product->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_category_slug_must_be_unique(): void
    {
        Category::create([
            'name' => 'Makeup',
            'slug' => 'makeup',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin);

        Livewire::test(CreateCategory::class)
            ->fillForm([
                'name' => 'Another Makeup',
                'slug' => 'makeup',
            ])
            ->call('create')
            ->assertHasFormErrors(['slug']);

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
            ->assertSee('Fragrance')
            ->assertSee('Parent category')
            ->assertSee('Show in navigation');
    }
}
