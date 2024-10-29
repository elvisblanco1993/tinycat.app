<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UploadRequestCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;

    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct(Request $request)
    {
        $this->clientName = $request->client->name;
        $this->url = route('upload-request.show', ['client' => $request->client_id, 'request' => $request->id]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Upload Request Completed by $this->clientName",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.upload-request-completed',
            with: [
                'clientName' => $this->clientName,
                'request_url' => $this->url,
            ],
        );
    }
}
