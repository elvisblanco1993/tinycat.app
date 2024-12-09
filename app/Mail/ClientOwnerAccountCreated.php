<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientOwnerAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $team;

    public $owner_name;

    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($team, $owner_name)
    {
        $this->team = $team;
        $this->owner_name = $owner_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your customer portal access - '.$this->team,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.client-owner-account-created',
            with: [
                'team' => $this->team,
                'owner_name' => $this->owner_name,
            ],
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
