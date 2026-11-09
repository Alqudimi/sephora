<?php

namespace App\Jobs;

use App\Mail\NewsletterWelcomeMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendNewsletterWelcomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(public readonly NewsletterSubscriber $subscriber)
    {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        Mail::to($this->subscriber->email)->send(new NewsletterWelcomeMail($this->subscriber));
    }

    public function failed(?Throwable $exception): void
    {
        Log::warning("Newsletter welcome email failed to send: {$exception?->getMessage()}", [
            'subscriber_id' => $this->subscriber->id,
            'email' => $this->subscriber->email,
        ]);
    }
}
