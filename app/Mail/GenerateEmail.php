<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class GenerateEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $subjectContent;
    private $htmlContent;

    public function __construct($subjectContent, $htmlContent)
    {
        $this->subjectContent = $subjectContent;
        $this->htmlContent = $htmlContent;
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

    public function build()
    {
        $email = $this->view('mail.generate-email')
            ->with('htmlContent', $this->htmlContent);

        $dom = new \DOMDocument();
        $dom->loadHTML($this->htmlContent);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $image) {
            $src = $image->getAttribute('src');

            if (str_contains($src, ';base64,')) {
                list($type, $data) = explode(';', $src);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);

                if ($data !== false) {
                    // Generar un nombre único
                    $imageName = 'image_' . Str::random(10) . '.jpg';
                    $path = storage_path('app/public/' . $imageName);

                    file_put_contents($path, $data);

                    $email->attach($path, [
                        'as' => $imageName,
                        'mime' => 'image/jpeg',
                    ]);

                    $cid = 'cid:' . $imageName;
                    $image->setAttribute('src', $cid);
                }
            }
        }

        // Guardar el nuevo HTML con las URLs de las imágenes actualizadas
        $this->htmlContent = $dom->saveHTML();

        return $email;
    }
}
