<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class DatabaseSqlSeeder extends Seeder
{
    /**
     * Path to the target SQL dump relative to base_path.
     */
    protected string $sqlFile = 'database.sql';

    /**
     * Threshold to consider the database already seeded.
     */
    protected int $productThreshold = 17000;

    /**
     * Run the database seeds.
     *
     * @param bool $force Force re-import even if data exists
     */
    public function run(bool $force = false): void
    {
        $filePath = base_path($this->sqlFile);

        if (! File::exists($filePath)) {
            $this->command?->error("SQL file not found at: {$filePath}");
            return;
        }

        // ── 1. Idempotency Check: Prevent duplicate import if executed twice ──
        if (! $force && $this->isAlreadySeeded()) {
            $productCount = DB::table('products')->count();
            $brandCount = DB::table('brands')->count();
            $categoryCount = DB::table('categories')->count();

            $this->command?->info(
                "✓ [DatabaseSqlSeeder] Database is already populated from {$this->sqlFile} " .
                "({$productCount} products, {$brandCount} brands, {$categoryCount} categories). " .
                "Skipping import to prevent duplicate records."
            );
            $this->command?->comment("Tip: Use --force or pass true to force re-import.");
            return;
        }

        $this->command?->info("→ [DatabaseSqlSeeder] Starting SQL pipeline from {$this->sqlFile}...");

        // ── 2. Import SQL dump using PostgreSQL client (COPY streaming) ──
        $this->importSqlWithPsql($filePath);

        // ── 3. Apply post-dump Laravel migrations (reconcile drift, audit, 2FA, webhooks) ──
        $this->command?->info("→ [DatabaseSqlSeeder] Applying pending migrations...");
        Artisan::call('migrate', ['--force' => true]);
        if ($output = trim(Artisan::output())) {
            $this->command?->line($output);
        }

        // ── 4. Clean up generic promotional banners and prioritize genuine product packshots ──
        $this->cleanupProductImages();

        // ── 5. Verify & display row counts ──
        $productCount = DB::table('products')->count();
        $brandCount = DB::table('brands')->count();
        $categoryCount = DB::table('categories')->count();
        $imagesCount = DB::table('product_images')->count();

        $this->command?->info(
            "✓ [DatabaseSqlSeeder] Successfully populated database from {$this->sqlFile}!\n" .
            "   • Brands:          {$brandCount}\n" .
            "   • Categories:      {$categoryCount}\n" .
            "   • Products:        {$productCount}\n" .
            "   • Product Images:  {$imagesCount}"
        );
    }

    /**
     * Detect if database.sql data is already present.
     */
    public function isAlreadySeeded(): bool
    {
        try {
            if (! DB::getSchemaBuilder()->hasTable('products')) {
                return false;
            }

            return DB::table('products')->count() >= $this->productThreshold;
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Execute SQL file via PostgreSQL psql binary for high-speed streaming COPY support.
     */
    protected function importSqlWithPsql(string $filePath): void
    {
        $connection = config('database.default', 'pgsql');
        $config = config("database.connections.{$connection}", []);

        $host = $config['host'] ?? '127.0.0.1';
        $port = (string) ($config['port'] ?? '5432');
        $database = $config['database'] ?? 'sephora';
        $username = $config['username'] ?? 'alqudimi';
        $password = $config['password'] ?? '';

        $command = [
            'psql',
            '-h', $host,
            '-p', $port,
            '-U', $username,
            '-d', $database,
            '-v', 'ON_ERROR_STOP=1',
            '-q',
            '-f', $filePath,
        ];

        $env = array_merge($_SERVER, $_ENV, [
            'PGPASSWORD' => $password,
        ]);

        $this->command?->info("→ [DatabaseSqlSeeder] Executing psql into {$database}@{$host}:{$port}...");

        $process = new Process($command, base_path(), $env, null, 300);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new \RuntimeException(
                "psql import failed (code {$process->getExitCode()}): " . $process->getErrorOutput()
            );
        }
    }

    /**
     * Purge generic marketing banners and optimize sort_order for genuine product packshots.
     */
    protected function cleanupProductImages(): void
    {
        $this->command?->info("→ [DatabaseSqlSeeder] Cleaning promotional banners from product_images...");

        DB::table('product_images')
            ->where(function ($q) {
                $q->where('path', 'like', '%1744x992%')
                    ->orWhere('path', 'like', '%brand_highlight%')
                    ->orWhere('path', 'like', '%brandhighlight%')
                    ->orWhere('path', 'like', '%BN_Box%')
                    ->orWhere('path', 'like', '%FragThematic%')
                    ->orWhere('path', 'like', '%GIFT/GWP%')
                    ->orWhere('path', 'like', '%noimagemedium%')
                    ->orWhere('path', 'like', '%banner%')
                    ->orWhere('path', 'like', '%promo%')
                    ->orWhere('path', 'like', '%pdp_gwp%')
                    ->orWhere('path', 'like', '%Potential_desktop%');
            })->delete();

        DB::statement("
            UPDATE product_images
            SET sort_order = CASE
                WHEN LOWER(path) LIKE '%swatch%' THEN 0
                WHEN LOWER(path) LIKE '%principal%' THEN 1
                WHEN LOWER(path) LIKE '%hi-res%' OR LOWER(path) LIKE '%mastercatalog%' THEN 2
                ELSE 3
            END
        ");

        $this->ensureLocalProductImages();
    }

    /**
     * Ensure every single product in the catalog has a guaranteed, fast, local image on disk.
     */
    protected function ensureLocalProductImages(): void
    {
        $this->command?->info("→ [DatabaseSqlSeeder] Guaranteeing verified local images on disk for all products...");

        $allFiles = array_values(array_filter(scandir(public_path('images/products')), function ($f) {
            if ($f === '.' || $f === '..') return false;
            $lf = strtolower($f);
            if (str_contains($lf, 'banner') || str_contains($lf, 'highlight') || str_contains($lf, '1744x992') || str_contains($lf, 'box') || str_contains($lf, 'gwp') || str_contains($lf, 'potential')) {
                return false;
            }
            return true;
        }));

        $localFilesSet = array_flip($allFiles);

        $skuMap = [];
        foreach ($allFiles as $f) {
            if (preg_match('/(P\d+|\d+)/i', $f, $m)) {
                $skuMap[$m[1]] = $f;
            }
        }

        $categoryPools = [];
        $matches = DB::table('product_images')
            ->join('category_product', 'product_images.product_id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->select('product_images.path', 'categories.slug as category_slug')
            ->get();

        foreach ($matches as $m) {
            $fn = basename(parse_url($m->path, PHP_URL_PATH) ?? $m->path);
            if (isset($localFilesSet[$fn])) {
                $categoryPools[$m->category_slug][$fn] = true;
            }
        }
        foreach ($categoryPools as $cat => $fns) {
            $categoryPools[$cat] = array_values(array_keys($fns));
        }

        $products = DB::table('products')->select('id', 'sku', 'name')->orderBy('id')->get();
        $prodCats = DB::table('category_product')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->select('category_product.product_id', 'categories.slug')
            ->get()
            ->groupBy('product_id');

        $existingImages = DB::table('product_images')
            ->select('id', 'product_id', 'path', 'sort_order')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('product_id');

        $now = now()->toDateTimeString();

        DB::statement('UPDATE product_images SET sort_order = sort_order + 1');

        $insertedRows = [];
        foreach ($products as $p) {
            $pid = $p->id;
            $pImages = $existingImages->get($pid, collect());
            $firstRecord = $pImages->first();
            $firstImg = $firstRecord?->path;
            $firstFn = basename(parse_url($firstImg ?? '', PHP_URL_PATH) ?? '');

            if ($firstFn !== '' && isset($localFilesSet[$firstFn])) {
                DB::table('product_images')
                    ->where('id', $firstRecord->id)
                    ->update(['path' => 'images/products/' . $firstFn, 'sort_order' => 0, 'updated_at' => $now]);
                continue;
            }

            $cleanSku = preg_replace('/^SKU_/i', '', $p->sku ?? '');
            $matchedFn = $skuMap[$cleanSku] ?? ($skuMap[$p->sku] ?? null);
            if ($matchedFn) {
                $chosenPath = 'images/products/' . $matchedFn;
            } else {
                $cats = $prodCats->get($pid, collect());
                $pool = null;
                foreach ($cats as $c) {
                    if (!empty($categoryPools[$c->slug])) {
                        $pool = $categoryPools[$c->slug];
                        break;
                    }
                }
                if (!$pool) {
                    $pool = $allFiles;
                }

                $hash = abs(crc32(($p->sku ?? '') . '_' . $pid));
                $chosenPath = 'images/products/' . $pool[$hash % count($pool)];
            }

            $insertedRows[] = [
                'product_id' => $pid,
                'path' => $chosenPath,
                'alt' => $p->name,
                'sort_order' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($insertedRows) >= 2000) {
                DB::table('product_images')->insert($insertedRows);
                $insertedRows = [];
            }
        }

        if (!empty($insertedRows)) {
            DB::table('product_images')->insert($insertedRows);
        }
    }
}


