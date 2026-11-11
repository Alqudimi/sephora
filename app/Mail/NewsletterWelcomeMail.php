<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterWelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly NewsletterSubscriber $subscriber)
    {
        $this->onQueue('emails');
        $this->locale(app()->getLocale());
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.subjects.newsletter_welcome', [], $this->locale),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-welcome',
            with: ['subscriber' => $this->subscriber],
        );
    }
}

