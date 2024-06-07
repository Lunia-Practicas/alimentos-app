<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GenerateEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(private $subjectContent, private $htmlContent)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS', 'example@example.com'),
            subject: $this->subjectContent
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.generate-email',
            with: ['htmlContent' => $this->htmlContent, 'subjectContent' => $this->subjectContent]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
