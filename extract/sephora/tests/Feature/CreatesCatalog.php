<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

trait CreatesCatalog
{
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
     * Real 1x1 JPEG binary. The GD extension is not available in every
     * environment, so UploadedFile::fake()->image() cannot be relied on;
     * this fixture passes the `image` MIME rule because its content is a
     * genuine JPEG.
     */
    public function realJpeg(?int $sizeInKilobytes = null, string $name = 'product.jpg'): UploadedFile
    {
        $content = base64_decode(
            '/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0a'
            .'HBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIy'
            .'MjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAED'
            .'ASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUF'
            .'BAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0'
            .'NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKj'
            .'pKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/9oA'
            .'DAMBAAIRAxEAPwD3+iiigD//2Q=='
        );

        if ($sizeInKilobytes !== null) {
            $content = str_pad($content, $sizeInKilobytes * 1024, "\0");
        }

        return UploadedFile::fake()->createWithContent($name, $content);
    }

    /**
     * Stop replaying the carried session cookie (simulate a different visitor).
     */
    public function dropCarriedSession(): void
    {
        $this->unencryptedCookies = [];
        $this->defaultCookies = [];
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
