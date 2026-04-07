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
        public string       $status,   // 'pending' | 'review' | 'shortlisted' | 'interview_scheduled' | 'selected' | 'rejected'
        public string|null  $message = null,
    ) {}

    public function envelope(): Envelope
    {
        $labels = [
            'pending'              => 'Application Status: Pending',
            'review'               => 'Application Status: Under Review',
            'shortlisted'          => 'Congratulations! You have been shortlisted',
            'interview_scheduled'  => 'Interview Scheduled',
            'selected'             => 'Congratulations! You have been selected',
            'rejected'             => 'Application Status Update',
        ];
        
        $label = $labels[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));

        return new Envelope(
            subject: "{$label} — {$this->opportunityTitle}",
            from: config('mail.from.address') ?? 'noreply@attachke.ac.ke',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-status',
            with: [
                'studentName'      => $this->studentName,
                'opportunityTitle' => $this->opportunityTitle,
                'orgName'          => $this->orgName,
                'status'           => $this->status,
                'message'          => $this->message,
            ],
        );
    }
}