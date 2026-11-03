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

    public function __construct(public readonly Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation · '.$this->order->order_number.' · SEPHORA UAE',
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
