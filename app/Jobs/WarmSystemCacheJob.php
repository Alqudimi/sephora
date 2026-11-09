<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WarmSystemCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        $this->onQueue('low');
    }

    public function handle(): void
    {
        // 1. Refresh sitemap
        Cache::forget('sitemap.xml');

        // 2. Pre-cache high-demand settings
        Setting::get('store_name');
        Setting::get('free_shipping_threshold');
        Setting::get('vat_rate_percent');

        // 3. Touch top active categories to keep query planner hot
        Category::query()->where('is_active', true)->withCount('products')->get();

        Log::info('System cache pre-warmed successfully.');
    }
}
