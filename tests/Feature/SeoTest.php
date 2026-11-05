<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_sitemap_renders_xml_with_lastmod_and_excludes_transactional_pages(): void
    {
        $product = $this->makeProduct(['updated_at' => now()->subDays(2)]);

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertSee('<urlset', false);
        $response->assertSee(url('/'), false);
        $response->assertSee(url('/p/'.$product->slug), false);
        $response->assertSee($product->updated_at->toAtomString(), false);

        // Transactional and account pages must never be crawled.
        $response->assertDontSee('/sign-in', false);
        $response->assertDontSee('/my-account', false);
        $response->assertDontSee('/checkout', false);
        $response->assertDontSee('/cart', false);
    }

    public function test_robots_txt_disallows_admin_and_advertises_sitemap(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertOk();
        $response->assertSee('User-agent: *', false);
        $response->assertSee('Disallow: /admin', false);
        $response->assertSee('Sitemap: '.config('app.url').'/sitemap.xml', false);
    }

    public function test_product_page_serves_canonical_og_and_json_ld(): void
    {
        $product = $this->makeProduct();

        $this->get(route('product.show', ['slug' => $product->slug]))
            ->assertOk()
            ->assertSee('rel="canonical"', false)
            ->assertSee('property="og:type"', false)
            ->assertSee('property="og:title"', false)
            ->assertSee('property="og:image"', false)
            ->assertSee('name="twitter:card"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee($product->name);
    }

    public function test_category_page_serves_canonical_og_and_breadcrumb_json_ld(): void
    {
        $product = $this->makeProduct();
        $category = Category::firstOrCreate(['slug' => 'makeup'], ['name' => 'Makeup']);

        $response = $this->get(route('shop.category', ['slug' => $category->slug]));

        $response->assertOk()
            ->assertSee('rel="canonical"', false)
            ->assertSee('property="og:title"', false)
            ->assertSee('property="og:description"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee($product->name);
    }

    public function test_public_pages_get_default_seo_tags_when_no_head_section_is_defined(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('rel="canonical"', false)
            ->assertSee('og:site_name', false)
            ->assertSee('og:type" content="website', false)
            ->assertSee('name="twitter:card"', false)
            ->assertSee('application/ld+json', false);
    }
}
