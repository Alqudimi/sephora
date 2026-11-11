<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderRefundedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Order $order)
    {
        $this->onQueue('emails');
        $pref = $order->user?->preferred_language;
        $this->locale(in_array($pref, ['en', 'ar'], true) ? $pref : app()->getLocale());
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.subjects.order_refunded', ['number' => $this->order->order_number], $this->locale),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-refunded',
            with: [
                'order' => $this->order,
            ],
        );
    }
}
