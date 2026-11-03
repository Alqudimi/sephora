<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

trait CreatesCatalog
{
    /**
     * Stop replaying the carried session cookie (simulate a different visitor).
     */
    public function dropCarriedSession(): void
    {
        $this->unencryptedCookies = [];
        $this->defaultCookies = [];
    }

    /**
     * Minimal catalog helper used by feature tests.
     */
    public function makeProduct(array $attrs = []): Product
    {
        $brand = Brand::firstOrCreate(
            ['slug' => 'test-brand'],
            ['name' => 'Test Brand'],
        );

        $category = Category::firstOrCreate(
            ['slug' => 'makeup'],
            ['name' => 'Makeup'],
        );

        static $n = 0;
        $n++;

        $product = Product::create(array_merge([
            'brand_id' => $brand->id,
            'name' => "Test Product {$n}",
            'slug' => "test-product-{$n}-".uniqid(),
            'price' => 100.00,
            'stock' => 50,
            'is_active' => true,
            'sort_order' => $n,
        ], $attrs));

        $product->categories()->sync([$category->id]);

        return $product->fresh();
    }

    /**
     * Replay the session cookie from a previous response so the next
     * request in the test shares the same session id (the cart is keyed
     * by session id in the database).
     */
    public function carrySession(object $response): static
    {
        $name = config('session.cookie', 'laravel_session');

        $cookie = collect($response->headers->getCookies())
            ->first(fn ($c) => $c->getName() === $name);

        if ($cookie) {
            // withCredentials: JSON requests skip cookies otherwise.
            // withUnencryptedCookie: replay the encrypted value verbatim.
            $this->withCredentials()
                ->withUnencryptedCookie($name, $cookie->getValue());
        }

        return $this;
    }
}
