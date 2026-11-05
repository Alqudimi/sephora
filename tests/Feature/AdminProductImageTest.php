<?php

namespace Tests\Feature;

use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProductImageTest extends TestCase
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

    public function test_admin_can_upload_product_image(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Velvet Night Serum',
            'price' => 275.50,
            'stock' => 25,
            'image' => UploadedFile::fake()->image('serum.jpg', 10, 10)->size(100),
        ]);

        $response->assertRedirect(route('admin.products'));

        $image = ProductImage::where('sort_order', 0)->firstOrFail();

        $this->assertNotNull($image->path);
        $this->assertSame('Velvet Night Serum', $image->alt);
        Storage::disk('public')->assertExists($image->path);
    }

    public function test_invalid_image_type_is_rejected(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Velvet Night Serum',
            'price' => 275.50,
            'stock' => 25,
            'image' => UploadedFile::fake()->create('notes.txt', 1, 'text/plain'),
        ]);

        $response->assertSessionHasErrors('image');
        $this->assertDatabaseCount('products', 0);
        Storage::disk('public')->assertMissing('products');
    }

    public function test_oversized_image_is_rejected(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Velvet Night Serum',
            'price' => 275.50,
            'stock' => 25,
            'image' => UploadedFile::fake()->image('huge.jpg', 10, 10)->size(6000),
        ]);

        $response->assertSessionHasErrors('image');
        $this->assertDatabaseCount('products', 0);
    }
}
