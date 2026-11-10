<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MapProductImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sephora:map-product-images {--dry-run : Simulate without writing to the database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replace remote HTTP product image URLs with local hashed disk paths and eliminate duplicate/generic banners';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $this->info('Starting Product Images Local Mapping & Deduplication...');

        // 1. Ensure public/images/products directory exists and links all files from images/products/
        $this->syncPublicProductImages();

        // 2. Load images.csv
        $csvFile = base_path('images/products/images.csv');
        if (! File::exists($csvFile)) {
            $this->error("images.csv not found at: {$csvFile}");
            return self::FAILURE;
        }

        $this->info('Loading images.csv...');
        $csvMap = [];
        $basenameMap = [];

        $handle = fopen($csvFile, 'r');
        fgetcsv($handle); // skip header
        while (($row = fgetcsv($handle)) !== false) {
            if (isset($row[0], $row[1])) {
                $url = trim($row[0]);
                $path = trim($row[1]);
                $csvMap[$url] = $path;

                $cleanUrl = explode('?', $url)[0];
                $base = basename($cleanUrl);
                if (! isset($basenameMap[$base])) {
                    $basenameMap[$base] = $path;
                }
            }
        }
        fclose($handle);
        $this->info('Loaded ' . count($csvMap) . ' mapped URLs and ' . count($basenameMap) . ' unique file basenames.');

        // 3. Process all rows in product_images
        $this->info('Auditing and updating product_images table in database...');

        // Products that had original HTTP rows vs products with only late bogus rows
        $origPids = ProductImage::where('id', '<=', 284278)->pluck('product_id')->unique()->flip()->all();

        $allImages = ProductImage::all();
        $totalRows = $allImages->count();
        $this->info("Total rows in product_images: {$totalRows}");

        $toDelete = [];
        $toUpdate = []; // id => new_path

        foreach ($allImages as $img) {
            $rawPath = $img->path;

            // Delete redundant bogus rows from Nov 8 (id > 284278) if product already had authentic images
            if ($img->id > 284278 && isset($origPids[$img->product_id])) {
                $toDelete[] = $img->id;
                continue;
            }

            // Check if generic marketing banner or promo
            if ($this->isGenericBanner($rawPath)) {
                $toDelete[] = $img->id;
                continue;
            }

            // Resolve local mapped disk path
            $resolvedPath = null;
            if (str_starts_with($rawPath, 'http')) {
                $resolvedPath = $this->resolveMappedUrl($rawPath, $csvMap);
            } else {
                $base = basename($rawPath);
                $resolvedPath = $basenameMap[$base] ?? null;
            }

            if (! $resolvedPath || $this->isGenericBanner($resolvedPath)) {
                $toDelete[] = $img->id;
                continue;
            }

            if ($resolvedPath !== $rawPath) {
                $toUpdate[$img->id] = $resolvedPath;
            }
        }

        $this->info('Identified ' . count($toDelete) . ' generic banners/redundant rows to remove.');
        $this->info('Identified ' . count($toUpdate) . ' rows to update with hashed disk path.');

        if (! $dryRun) {
            DB::transaction(function () use ($toDelete, $toUpdate) {
                // Delete in chunks
                foreach (array_chunk($toDelete, 500) as $chunk) {
                    ProductImage::whereIn('id', $chunk)->delete();
                }

                // Update in chunks
                foreach (array_chunk($toUpdate, 500, true) as $chunk) {
                    foreach ($chunk as $id => $path) {
                        ProductImage::where('id', $id)->update([
                            'path' => $path,
                            'updated_at' => now(),
                        ]);
                    }
                }
            });
        }

        // 4. Ensure each product has distinct, dedicated primary image and correct sort_order
        $this->info('Organizing sort_order and prioritizing distinct product packshots...');
        $products = Product::with(['images'])->get();
        $missingImagesCount = 0;

        foreach ($products as $product) {
            $images = $product->images;
            if ($images->isEmpty()) {
                $missingImagesCount++;
                continue;
            }

            // Rank images: SKU matching swatch > PID matching swatch > general swatch > principal > others
            $skuNum = str_replace('SKU_', '', $product->sku);
            $pidNum = $product->sku;

            $ranked = $images->sortBy(function ($img) use ($skuNum, $pidNum) {
                $p = $img->path;
                $score = 100;
                if (str_contains($p, $skuNum)) $score -= 50;
                if (str_starts_with($pidNum, 'P') && str_contains($p, $pidNum)) $score -= 40;
                if (str_contains($p, 'swatch')) $score -= 20;
                if (str_contains($p, 'principal')) $score -= 15;
                if (str_contains($p, 'main')) $score -= 10;
                return $score;
            })->values();

            // Deduplicate paths for the same product and assign sequential sort_orders
            $seenPaths = [];
            $order = 0;

            foreach ($ranked as $img) {
                if (isset($seenPaths[$img->path])) {
                    if (! $dryRun) {
                        $img->delete();
                    }
                    continue;
                }

                $seenPaths[$img->path] = true;
                if (! $dryRun && $img->sort_order !== $order) {
                    $img->update(['sort_order' => $order]);
                }
                $order++;
            }
        }

        // Handle missing products (variants inheriting parent image if any)
        if ($missingImagesCount > 0) {
            $this->warn("Found {$missingImagesCount} products with no remaining images. Attempting variant inheritance...");
            if (! $dryRun) {
                $this->healMissingProductImages();
            }
        }

        // 5. Verification
        $finalTotal = ProductImage::count();
        $finalHttp = ProductImage::where('path', 'like', 'http%')->count();
        $this->info("Final total product_images: {$finalTotal}");
        $this->info("Final remote HTTP product_images: {$finalHttp} (Target: 0)");

        $this->info('Product images mapping successfully completed!');
        return self::SUCCESS;
    }

    /**
     * Map HTTP URL to local path.
     */
    protected function resolveMappedUrl(string $url, array &$csvMap): ?string
    {
        if (isset($csvMap[$url])) {
            return $csvMap[$url];
        }

        $u2 = str_replace(
            'https://bkwk-prd.my.commercecloud.salesforce.com',
            'https://img-product.sephora.me/dw/image/v2/BKWK_PRD',
            $url
        );
        if (isset($csvMap[$u2])) {
            return $csvMap[$u2];
        }

        $u3 = str_replace(
            'https://www.sephora.sa',
            'https://img-product.sephora.me/dw/image/v2/BKWK_PRD',
            $url
        );
        if (isset($csvMap[$u3])) {
            return $csvMap[$u3];
        }

        return null;
    }

    /**
     * Check if a path or URL points to a generic marketing banner / reassurance graphic.
     */
    protected function isGenericBanner(string $path): bool
    {
        $lp = strtolower($path);
        return str_contains($lp, '1744x992')
            || str_contains($lp, 'brand_highlight')
            || str_contains($lp, 'brandhighlight')
            || str_contains($lp, 'bn_box')
            || str_contains($lp, 'fragthematic')
            || str_contains($lp, 'gwp')
            || str_contains($lp, 'gift')
            || str_contains($lp, 'authorized-retailer')
            || str_contains($lp, 'placeholder')
            || str_contains($lp, 'reassurance')
            || str_contains($lp, 'image.png')
            || str_contains($lp, '765003dandgbodycream296')
            || str_contains($lp, '733904lancomeset296')
            || str_contains($lp, 'laneige_keychain')
            || str_contains($lp, 'avocado-eye-cream')
            || str_contains($lp, '827571-tarte')
            || str_contains($lp, '844777-00')
            || str_contains($lp, '0766616_0')
            || str_contains($lp, '515710_nudestix')
            || str_contains($lp, '0826036')
            || str_contains($lp, '6295157802667')
            || str_contains($lp, 'noimagemedium');
    }

    /**
     * Synchronize public/images/products with images/products via hard links.
     */
    protected function syncPublicProductImages(): void
    {
        $srcDir = base_path('images/products');
        $dstDir = public_path('images/products');

        if (! File::isDirectory($dstDir)) {
            File::makeDirectory($dstDir, 0755, true);
        }

        if (File::isDirectory($srcDir)) {
            $files = scandir($srcDir);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || str_ends_with($file, '.csv')) {
                    continue;
                }
                $src = $srcDir . '/' . $file;
                $dst = $dstDir . '/' . $file;
                if (! file_exists($dst)) {
                    @link($src, $dst) ?: @copy($src, $dst);
                }
            }
            @chmod($dstDir, 0755);
        }
    }

    /**
     * Heal any product lacking an image by inheriting from same-name product or finding swatch.
     */
    protected function healMissingProductImages(): void
    {
        $missing = Product::whereDoesntHave('images')->get();
        foreach ($missing as $product) {
            $sibling = Product::where('name', $product->name)
                ->where('id', '!=', $product->id)
                ->whereHas('images')
                ->with('images')
                ->first();

            if ($sibling && $sibling->images->isNotEmpty()) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $sibling->images->first()->path,
                    'alt' => $product->name,
                    'sort_order' => 0,
                ]);
            } else {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => 'images/placeholder.webp',
                    'alt' => $product->name,
                    'sort_order' => 0,
                ]);
            }
        }
    }
}
