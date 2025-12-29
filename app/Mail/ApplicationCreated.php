<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('jeffrey@example.com', 'Jeffrey Way'),

            replyTo: [new Address('taylor@example.com', 'Taylor Otwell'),],

            subject: 'Application Created',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.application-created',
        );
    }

    public function attachments(): array
    {
       $attachments = [];

        if(!empty($this->applicatin['files'])){
            foreach ($this->application['files'] as $key => $file) {
                $attachments[] = Attachment::fromPath($file);
            }
        }

        return $attachments;
    }
}
