<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class OrderConfirmationMail extends Mailable implements ShouldQueue
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
            subject: __('emails.subjects.order_confirmation', ['number' => $this->order->order_number], $this->locale),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
            with: [
                'order' => $this->order,
                'trackingUrl' => $this->trackingUrl(),
            ],
        );
    }

    /**
     * Signed guest-friendly link to the order confirmation page.
     */
    private function trackingUrl(): string
    {
        $user = $this->order->user;

        if ($user) {
            return URL::to("/my-account/orders/{$this->order->order_number}");
        }

        return URL::temporarySignedRoute(
            'checkout.confirmation.guest',
            now()->addDays(30),
            ['order' => $this->order->order_number],
        );
    }
}
