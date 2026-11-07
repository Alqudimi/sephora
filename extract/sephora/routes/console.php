<?php

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;

/*

|--------------------------------------------------------------------------
| Console Routes & Scheduled Tasks
|--------------------------------------------------------------------------
|
| Production cron entry (runs every minute):
|   * * * * * cd /var/www/sephora && php artisan schedule:run >> /dev/null 2>&1
|
*/

// Housekeeping: remove guest carts whose sessions are long gone (30 days)
// and deactivate coupons past their expiry date. Runs daily at 03:00.
// cart_items cascade on delete via the foreign key.
Schedule::call(function () {
    $cutoff = now()->subDays(30);

    Cart::query()
        ->whereNull('user_id')
        ->where('updated_at', '<', $cutoff)
        ->delete();

    Coupon::query()
        ->where('is_active', true)
        ->whereNotNull('expires_at')
        ->where('expires_at', '<', today())
        ->update(['is_active' => false]);
})->daily()->at('03:00')->name('shop-housekeeping');

// Keep the sitemap fresh.
Schedule::call(function () {
    Cache::forget('sitemap.xml');
})->daily()->at('03:10')->name('sitemap-refresh');

Schedule::command('queue:prune-batches --hours=48')->daily();
