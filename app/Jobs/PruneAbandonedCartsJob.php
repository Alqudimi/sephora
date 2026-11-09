<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PruneAbandonedCartsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public readonly int $daysOld = 30)
    {
        $this->onQueue('low');
    }

    public function handle(): void
    {
        $cutoff = now()->subDays($this->daysOld);

        $prunedCarts = Cart::query()
            ->whereNull('user_id')
            ->where('updated_at', '<', $cutoff)
            ->delete();

        $expiredCoupons = Coupon::query()
            ->where('is_active', true)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', today())
            ->update(['is_active' => false]);

        Log::info("Pruned {$prunedCarts} abandoned guest carts and deactivated {$expiredCoupons} expired coupons.");
    }
}
