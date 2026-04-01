<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $orgName,
        public string $studentName,
        public string $opportunityTitle,
        public string $applicationDate,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Attachment Application — ' . $this->opportunityTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-submitted',
        );
    }
}