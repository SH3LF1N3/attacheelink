<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string       $studentName,
        public string       $opportunityTitle,
        public string       $orgName,
        public string       $interviewDate,
        public string       $interviewTime,
        public string       $interviewType,      // 'physical' or 'online'
        public string|null  $locationOrLink,     // address or zoom link
        public string|null  $notes = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Interview Scheduled — {$this->opportunityTitle} at {$this->orgName}",
            from: config('mail.from.address') ?? 'noreply@attachke.ac.ke',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interview-scheduled',
            with: [
                'studentName'      => $this->studentName,
                'opportunityTitle' => $this->opportunityTitle,
                'orgName'          => $this->orgName,
                'interviewDate'    => $this->interviewDate,
                'interviewTime'    => $this->interviewTime,
                'interviewType'    => $this->interviewType,
                'locationOrLink'   => $this->locationOrLink,
                'notes'            => $this->notes,
            ],
        );
    }
}
