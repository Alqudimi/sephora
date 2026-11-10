<?php

namespace Tests\Feature;

use App\Models\ProductImage;
use App\Support\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ProductImagesMappingTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    /**
     * Test that media_url generates a valid asset URL for local paths.
     */
    public function test_media_url_returns_asset(): void
    {
        $product = $this->makeProduct();
        $image = ProductImage::create([
            'product_id' => $product->id,
            'path' => 'images/products/829255_swatch__a9e76bf3137d0de7e8211259d5a029915db884d8530d3578789a8df875fb8c68.jpg',
            'sort_order' => 0,
        ]);

        $url = Media::url($image->path);
        $this->assertStringContainsString('images/products/', $url);
        $this->assertStringStartsWith('http', $url);
    }

    /**
     * Test that first_image attribute excludes generic banners.
     */
    public function test_first_image_excludes_generic_banners(): void
    {
        $product = $this->makeProduct();

        ProductImage::create([
            'product_id' => $product->id,
            'path' => 'images/products/PDP_Brand_Highlight.jpg',
            'sort_order' => 0,
        ]);

        $realImage = ProductImage::create([
            'product_id' => $product->id,
            'path' => 'images/products/829255_swatch__a9e76bf3137d0de7e8211259d5a029915db884d8530d3578789a8df875fb8c68.jpg',
            'sort_order' => 1,
        ]);

        $firstImage = $product->first_image;
        $this->assertSame($realImage->path, $firstImage);
    }

    /**
     * Test that command executes properly.
     */
    public function test_map_product_images_command_runs_successfully(): void
    {
        $this->artisan('sephora:map-product-images', ['--dry-run' => true])
            ->assertSuccessful();
    }
}
