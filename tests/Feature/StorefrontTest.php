<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_unknown_product_returns_404(): void
    {
        $this->get('/p/this-product-does-not-exist')->assertStatus(404);
    }

    public function test_inactive_product_returns_404(): void
    {
        $product = $this->makeProduct(['is_active' => false]);

        $this->get(route('product.show', ['slug' => $product->slug]))->assertStatus(404);
    }

    public function test_product_page_renders_real_product_data(): void
    {
        $product = $this->makeProduct([
            'name' => 'Midnight Rose Eau de Parfum',
            'price' => 349.50,
            'sku' => 'MR-100',
            'description' => 'A deep floral fragrance built around damask rose.',
            'how_to_use' => 'Spray onto pulse points from 15cm away.',
            'ingredients' => 'Alcohol denat., parfum, aqua.',
        ]);

        $response = $this->get(route('product.show', ['slug' => $product->slug]));

        $response->assertOk()
            ->assertSee('Midnight Rose Eau de Parfum')
            ->assertSee('AED 349.50')
            ->assertSee('MR-100')
            ->assertSee('Spray onto pulse points from 15cm away.')
            ->assertSee('Alcohol denat., parfum, aqua.')
            ->assertSee('Write a review')
            ->assertSee('application/ld+json', false)
            ->assertSee('rel="canonical"', false);
    }

    public function test_product_page_renders_shades_and_stock_state(): void
    {
        $product = $this->makeProduct(['stock' => 3]);
        $product->shades()->create(['name' => 'Rose Nude', 'hex_color' => '#c98b7f', 'stock' => 2, 'sort_order' => 1]);
        $product->shades()->create(['name' => 'Deep Berry', 'hex_color' => '#6d1f2c', 'stock' => 0, 'sort_order' => 2]);

        $this->get(route('product.show', ['slug' => $product->slug]))
            ->assertOk()
            ->assertSee('Rose Nude')
            ->assertSee('Deep Berry')
            ->assertSee('Only 3 left');
    }

    public function test_category_page_lists_only_products_from_that_category(): void
    {
        $makeup = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $lipstick = $this->makeProduct(['name' => 'Velvet Lipstick']);
        $mascara = $this->makeProduct(['name' => 'Volume Mascara']);

        $otherCategory = Category::create(['slug' => 'fragrance-test', 'name' => 'Fragrance Test']);
        $perfume = $this->makeProduct(['name' => 'Amber Oud']);
        $perfume->categories()->sync([$otherCategory->id]);

        $response = $this->get(route('shop.category', ['slug' => $makeup->slug]));

        $response->assertOk()
            ->assertSee('Velvet Lipstick')
            ->assertSee('Volume Mascara')
            ->assertDontSee('Amber Oud');

        $listed = $response->viewData('products');
        $this->assertEquals(2, $listed->total());
        $this->assertEqualsCanonicalizing(
            [$lipstick->id, $mascara->id],
            $listed->pluck('id')->all()
        );
    }

    public function test_category_page_filters_by_brand_and_price(): void
    {
        $makeup = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $premiumBrand = Brand::create(['name' => 'Premium Brand', 'slug' => 'premium-brand']);
        $valueBrand = Brand::create(['name' => 'Value Brand', 'slug' => 'value-brand']);

        $expensive = $this->makeProduct([
            'name' => 'Luxury Serum',
            'brand_id' => $premiumBrand->id,
            'price' => 420,
        ]);
        $cheap = $this->makeProduct([
            'name' => 'Everyday Cleanser',
            'brand_id' => $valueBrand->id,
            'price' => 65,
        ]);

        $byBrand = $this->get(route('shop.category', ['slug' => $makeup->slug, 'brand' => 'value-brand']));
        $byBrand->assertOk()->assertSee('Everyday Cleanser')->assertDontSee('Luxury Serum');
        $this->assertEquals([$cheap->id], $byBrand->viewData('products')->pluck('id')->all());

        $byPrice = $this->get(route('shop.category', ['slug' => $makeup->slug, 'max_price' => 100]));
        $byPrice->assertOk()->assertSee('Everyday Cleanser')->assertDontSee('Luxury Serum');
        $this->assertEquals([$cheap->id], $byPrice->viewData('products')->pluck('id')->all());
    }

    public function test_category_page_sorts_by_price(): void
    {
        $makeup = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $mid = $this->makeProduct(['name' => 'Mid Priced', 'price' => 200]);
        $low = $this->makeProduct(['name' => 'Low Priced', 'price' => 50]);
        $high = $this->makeProduct(['name' => 'High Priced', 'price' => 800]);

        $ascending = $this->get(route('shop.category', ['slug' => $makeup->slug, 'sort' => 'price_asc']));
        $this->assertEquals([$low->id, $mid->id, $high->id], $ascending->viewData('products')->pluck('id')->all());

        $descending = $this->get(route('shop.category', ['slug' => $makeup->slug, 'sort' => 'price_desc']));
        $this->assertEquals([$high->id, $mid->id, $low->id], $descending->viewData('products')->pluck('id')->all());
    }

    public function test_category_page_paginates_at_twelve_products(): void
    {
        $makeup = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        for ($i = 0; $i < 14; $i++) {
            $this->makeProduct();
        }

        $firstPage = $this->get(route('shop.category', ['slug' => $makeup->slug]));
        $firstPage->assertOk();

        $paginator = $firstPage->viewData('products');
        $this->assertCount(12, $paginator->items());
        $this->assertEquals(2, $paginator->lastPage());

        $secondPage = $this->get(route('shop.category', ['slug' => $makeup->slug, 'page' => 2]));
        $secondPage->assertOk();
        $this->assertCount(2, $secondPage->viewData('products')->items());
    }

    public function test_unknown_category_returns_404(): void
    {
        $this->get(route('shop.category', ['slug' => 'not-a-real-category']))->assertStatus(404);
    }

    public function test_inactive_category_returns_404(): void
    {
        Category::create(['slug' => 'hidden-category', 'name' => 'Hidden', 'is_active' => false]);

        $this->get(route('shop.category', ['slug' => 'hidden-category']))->assertStatus(404);
    }

    public function test_guest_cannot_submit_a_review(): void
    {
        $product = $this->makeProduct();

        $this->post(route('reviews.store', ['product' => $product->slug]), [
            'rating' => 5,
            'body' => 'Absolutely wonderful product that I use daily.',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseCount('reviews', 0);
    }

    public function test_authenticated_review_is_moderated_before_publishing(): void
    {
        $user = User::factory()->create(['name' => 'Layla H.']);
        $product = $this->makeProduct();

        $response = $this->actingAs($user)->post(route('reviews.store', ['product' => $product->slug]), [
            'rating' => 4,
            'title' => 'Beautiful finish',
            'body' => 'Lovely texture and it lasts all day without drying my skin.',
        ]);

        $response->assertRedirect(route('product.show', ['slug' => $product->slug]));
        $response->assertSessionHas('review_status');

        $this->assertDatabaseHas('reviews', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'author_name' => 'Layla H.',
            'rating' => 4,
            'is_approved' => false,
        ]);

        // Pending reviews are not shown on the storefront.
        $this->get(route('product.show', ['slug' => $product->slug]))
            ->assertOk()
            ->assertDontSee('Lovely texture and it lasts all day without drying my skin.');
    }

    public function test_approved_reviews_are_rendered_on_the_product_page(): void
    {
        $product = $this->makeProduct();

        Review::create([
            'product_id' => $product->id,
            'author_name' => 'Noor A.',
            'rating' => 5,
            'title' => 'Repurchasing',
            'body' => 'This is my third bottle and it never disappoints.',
            'is_approved' => true,
        ]);

        $this->get(route('product.show', ['slug' => $product->slug]))
            ->assertOk()
            ->assertSee('Noor A.')
            ->assertSee('Repurchasing')
            ->assertSee('This is my third bottle and it never disappoints.');
    }

    public function test_review_rating_must_be_between_one_and_five(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $this->actingAs($user)->post(route('reviews.store', ['product' => $product->slug]), [
            'rating' => 9,
            'body' => 'A review body that is long enough to pass validation.',
        ])->assertSessionHasErrors('rating');

        $this->assertDatabaseCount('reviews', 0);
    }

    public function test_shop_all_route_renders_and_lists_active_products(): void
    {
        $product1 = $this->makeProduct(['name' => 'Iconic Lipstick Red']);
        $product2 = $this->makeProduct(['name' => 'Hydrating Face Serum']);

        $response = $this->get('/shop');
        $response->assertOk()
            ->assertSee('All Products')
            ->assertSee('Iconic Lipstick Red')
            ->assertSee('Hydrating Face Serum');

        $responseAlias = $this->get('/shop/all');
        $responseAlias->assertOk()
            ->assertSee('All Products');
    }
}
