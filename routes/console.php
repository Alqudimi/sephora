<?php

use App\Jobs\CancelUnpaidOrdersJob;
use App\Jobs\PruneAbandonedCartsJob;
use App\Jobs\WarmSystemCacheJob;
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

// Housekeeping: remove guest carts older than 30 days and deactivate expired coupons
Schedule::job(new PruneAbandonedCartsJob(30))->daily()->at('03:00')->name('shop-housekeeping');

// Keep high-demand cache and sitemap warm
Schedule::job(new WarmSystemCacheJob)->daily()->at('03:10')->name('system-cache-warm');

// Release stock held by checkouts that never completed payment (pending + unpaid for > 48h)
Schedule::job(new CancelUnpaidOrdersJob(48))->hourly()->name('cancel-abandoned-pending');

// Clean up stale queue batches and failed job logs
Schedule::command('queue:prune-batches --hours=48')->daily();
Schedule::command('queue:prune-failed --hours=168')->weekly();
