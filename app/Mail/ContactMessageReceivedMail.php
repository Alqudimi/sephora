<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceivedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly ContactMessage $contactMessage)
    {
        $this->onQueue('emails');
        $this->locale(app()->getLocale());
    }

    public function envelope(): Envelope
    {
        $subject = $this->contactMessage->subject ?: __('emails.subjects.contact_general', [], $this->locale);

        return new Envelope(
            subject: __('emails.subjects.contact_received', [
                'name' => $this->contactMessage->name,
                'subject' => $subject,
            ], $this->locale),
            replyTo: [$this->contactMessage->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
            with: ['msg' => $this->contactMessage],
        );
    }
}

