<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $fullName,
        public string $userEmail,
        public string $phone,
        public string $subject,
        public string $message,
    ) {}

    public function envelope(): Envelope
    {
        $subjectLabels = [
            'general'       => 'General Enquiry',
            'student'       => 'Student Support',
            'organisation'  => 'Organisation Support',
            'technical'     => 'Technical Issue',
            'partnership'   => 'Partnership',
            'other'         => 'Other',
        ];

        $label = $subjectLabels[$this->subject] ?? 'Contact Form';

        return new Envelope(
            subject: "New Contact Form Submission: {$label}",
            from: config('mail.from.address') ?? 'noreply@attachke.ac.ke',
            replyTo: [$this->userEmail],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}
