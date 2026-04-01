<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string       $studentName,
        public string       $opportunityTitle,
        public string       $orgName,
        public string       $status,   // 'shortlisted' | 'under_review' | 'rejected'
        public string|null  $message = null,
    ) {}

    public function envelope(): Envelope
    {
        $labels = [
            'shortlisted'  => 'Shortlisted',
            'under_review' => 'Under Review',
            'rejected'     => 'Not Successful',
        ];
        $label = $labels[$this->status] ?? ucfirst($this->status);

        return new Envelope(
            subject: "Application Update: {$label} — {$this->opportunityTitle}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.application-status');
    }
}