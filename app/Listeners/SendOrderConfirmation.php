<?php

namespace App\Listeners;

use App\Mail\AdminNewOrderAlert;
use App\Mail\OrderConfirmationMail;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewOrderPlacedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendOrderConfirmation implements ShouldQueue
{
    public string $queue = 'emails';

    public int $tries = 3;

    public int $backoff = 60;

    /**
     * Send the customer confirmation email (and an optional admin alert
     * when the "admin_notify_email" setting is configured), plus the
     * in-panel database notification for every staff account.
     */
    public function handle(object $event): void
    {
        $order = $event->order;

        if ($email = $order->customer_email ?: $order->guest_email) {
            Mail::to($email)->send(new OrderConfirmationMail($order));
        }

        if ($adminEmail = Setting::get('admin_notify_email')) {
            Mail::to($adminEmail)->send(new AdminNewOrderAlert($order));
        }

        $staff = User::query()
            ->where(fn ($query) => $query
                ->whereIn('role', ['admin', 'manager', 'support'])
                ->orWhere('is_admin', true))
            ->get();

        if ($staff->isNotEmpty()) {
            Notification::send($staff, new NewOrderPlacedNotification($order));
        }
    }
}
