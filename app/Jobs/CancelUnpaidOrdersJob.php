<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\Orders\OrderStateMachine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class CancelUnpaidOrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public readonly int $hoursOld = 48)
    {
        $this->onQueue('default');
    }

    public function handle(OrderStateMachine $stateMachine): void
    {
        $cutoff = now()->subHours($this->hoursOld);

        $abandoned = Order::query()
            ->where('status', 'pending')
            ->where('payment_status', 'pending')
            ->where('placed_at', '<', $cutoff)
            ->get();

        $cancelledCount = 0;

        foreach ($abandoned as $order) {
            try {
                $stateMachine->transition($order, 'cancelled', [
                    'cancel_reason' => 'Payment expired (unpaid online order automatically cancelled after 48 hours). Stock restored.',
                ]);
                $cancelledCount++;
            } catch (Throwable $e) {
                // Order already transitioned or paid
            }
        }

        if ($cancelledCount > 0) {
            Log::info("Cancelled {$cancelledCount} expired unpaid orders and restored held inventory.");
        }
    }
}
