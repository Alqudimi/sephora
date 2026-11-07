<?php

namespace Tests\Feature;

use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Models\ProductImage;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
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
            'role' => 'admin',
            'email' => 'admin@sephora.test',
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function test_admin_can_upload_product_image(): void
    {
        Storage::fake('public');
        $product = $this->makeProduct();

        $this->actingAs($this->admin);

        Livewire::test(ImagesRelationManager::class, [
            'ownerRecord' => $product,
            'pageClass' => EditProduct::class,
        ])
            ->callAction(TestAction::make('create')->table(), data: [
                'path' => $this->realJpeg(),
                'alt' => $product->name,
                'sort_order' => 0,
            ])
            ->assertHasNoFormErrors();

        $image = ProductImage::where('sort_order', 0)->firstOrFail();

        $this->assertNotNull($image->path);
        $this->assertSame($product->name, $image->alt);
        Storage::disk('public')->assertExists($image->path);
    }

    public function test_invalid_image_type_is_rejected(): void
    {
        Storage::fake('public');
        $product = $this->makeProduct();

        $this->actingAs($this->admin);

        Livewire::test(ImagesRelationManager::class, [
            'ownerRecord' => $product,
            'pageClass' => EditProduct::class,
        ])
            ->callAction(TestAction::make('create')->table(), data: [
                'path' => UploadedFile::fake()->create('notes.txt', 1, 'text/plain'),
            ])
            ->assertHasFormErrors(['path']);

        $this->assertDatabaseCount('product_images', 0);
    }

    public function test_oversized_image_is_rejected(): void
    {
        Storage::fake('public');
        $product = $this->makeProduct();

        $this->actingAs($this->admin);

        Livewire::test(ImagesRelationManager::class, [
            'ownerRecord' => $product,
            'pageClass' => EditProduct::class,
        ])
            ->callAction(TestAction::make('create')->table(), data: [
                'path' => $this->realJpeg(sizeInKilobytes: 9000, name: 'huge.jpg'),
            ])
            ->assertHasFormErrors(['path']);

        $this->assertDatabaseCount('product_images', 0);
    }

    public function test_support_cannot_manage_product_images(): void
    {
        Storage::fake('public');
        $product = $this->makeProduct();
        $support = User::factory()->create([
            'role' => 'support',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($support);

        // The relation manager authorizes against the parent product —
        // support never sees the add-image action.
        Livewire::test(ImagesRelationManager::class, [
            'ownerRecord' => $product,
            'pageClass' => EditProduct::class,
        ])
            ->assertActionHidden(TestAction::make('create')->table());

        $this->assertDatabaseCount('product_images', 0);
    }
}
