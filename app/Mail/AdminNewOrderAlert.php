<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewOrderAlert extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Order $order)
    {
        $this->onQueue('emails');
        $this->locale(app()->getLocale());
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.subjects.admin_new_order', [
                'number' => $this->order->order_number,
                'total' => number_format($this->order->total, 2),
            ], $this->locale),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-order',
            with: ['order' => $this->order],
        );
    }
}
