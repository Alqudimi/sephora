<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * In-panel database notification (the admin bell) fired whenever a new
 * order is placed.
 */
class NewOrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Order $order) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'order_number' => $this->order->order_number,
            'order_id' => $this->order->getKey(),
            'customer' => $this->order->customer_name,
            'total' => (float) $this->order->total,
            'payment_method' => $this->order->payment_method_label,
        ];
    }
}
