<?php

namespace App\Jobs;

use App\Models\PaymentWebhookEvent;
use App\Services\Payments\WebhookProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessPaymentWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;

    public array $backoff = [10, 60, 300];

    public function __construct(public readonly PaymentWebhookEvent $event)
    {
        $this->onQueue('payments');
    }

    public function handle(WebhookProcessor $processor): void
    {
        if ($this->event->processed_at !== null) {
            return;
        }

        $result = $processor->process($this->event);

        if ($result['applied']) {
            Log::info("Payment webhook applied successfully: Order {$result['order_number']}", [
                'event_id' => $this->event->event_id,
                'gateway' => $this->event->gateway,
            ]);
        }
    }

    public function failed(?Throwable $exception): void
    {
        Log::error("Payment webhook processing failed after retries: {$this->event->event_id}", [
            'gateway' => $this->event->gateway,
            'error' => $exception?->getMessage(),
        ]);
    }
}
