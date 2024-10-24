<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class UploadRequestSent extends Mailable
{
    use Queueable, SerializesModels;

    public $requestor;
    public $message;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct(Request $request)
    {
        $this->requestor = $request->team->name;
        $this->message = $request->message;
        $this->url = URL::signedRoute('my.request.show', ['request' => $request->ulid]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New request from ' . $this->requestor,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.upload-request-sent',
            with: [
                'requestor' => $this->requestor,
                'message' => $this->message,
                'request_url' => $this->url,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
