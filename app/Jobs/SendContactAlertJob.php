<?php

namespace App\Jobs;

use App\Mail\ContactMessageReceivedMail;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendContactAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(public readonly ContactMessage $contactMessage)
    {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        $adminEmail = Setting::get('admin_notify_email')
            ?: Setting::get('contact_email', config('mail.from.address'));

        if (! $adminEmail || ! filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        Mail::to($adminEmail)->send(new ContactMessageReceivedMail($this->contactMessage));
    }

    public function failed(?Throwable $exception): void
    {
        Log::warning("Contact alert email failed to send: {$exception?->getMessage()}", [
            'contact_message_id' => $this->contactMessage->id,
        ]);
    }
}
