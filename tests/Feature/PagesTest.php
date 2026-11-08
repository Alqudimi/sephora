<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $this->makeProduct();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_key_content_pages_load(): void
    {
        $this->makeProduct();

        foreach (['/beauty-offers', '/brands', '/contact-us', '/faq', '/gift-card-info', '/download-app', '/clean-at-sephora', '/stores', '/terms-and-conditions'] as $uri) {
            $this->get($uri)->assertStatus(200);
        }
    }

    public function test_category_pages_load(): void
    {
        $this->makeProduct();
        foreach (['new', 'gifts', 'bestsellers', 'minis-more'] as $slug) {
            Category::firstOrCreate(['slug' => $slug], ['name' => ucfirst($slug)]);
        }

        foreach (['/shop/makeup', '/shop/new', '/shop/gifts', '/shop/bestsellers'] as $uri) {
            $this->get($uri)->assertStatus(200);
        }
    }

    public function test_product_page_loads(): void
    {
        $product = $this->makeProduct();

        $this->get("/p/{$product->slug}")
            ->assertStatus(200);
    }

    public function test_search_returns_results(): void
    {
        $product = $this->makeProduct(['name' => 'Wonder Serum Deluxe']);

        $response = $this->get('/search?q=Wonder+Serum');

        $response->assertStatus(200);
        $response->assertSee('Wonder Serum Deluxe');
    }

    public function test_unknown_page_returns_styled_404(): void
    {
        $response = $this->get('/this-page-does-not-exist');

        $response->assertStatus(404);
        $response->assertSee('sold out', false);
    }

    public function test_sitemap_renders_xml(): void
    {
        $this->makeProduct();

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function test_security_headers_present(): void
    {
        $response = $this->get('/');

        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $this->assertStringContainsString("default-src 'self'", $response->headers->get('Content-Security-Policy'));
        $this->assertStringContainsString("img-src 'self' data: https: blob:;", $response->headers->get('Content-Security-Policy'));
    }
}
