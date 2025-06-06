<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

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
        $this->url = route('upload-request.show', ['client' => $request->client_id, 'request' => $request->id]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New request from '.$this->requestor,
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
}
