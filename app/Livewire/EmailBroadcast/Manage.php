<?php

namespace App\Livewire\EmailBroadcast;

use Livewire\Component;
use App\Models\Audience;
use App\Models\EmailBroadcast;
use Illuminate\Support\Facades\DB;

class Manage extends Component
{
    public EmailBroadcast $broadcast;
    public $name = 'Untitled';
    public $reply_to;
    public $audience;
    public $audience_list = [];
    public $subject;
    public $preview;
    public $message;
    public $send_at;

    public function mount()
    {
        $this->authorize('create', EmailBroadcast::class);
        $this->audience_list = Audience::get();
    }

    public function render()
    {
        return view('livewire.email-broadcast.manage');
    }

    public function send()
    {
        $this->validate([
            'reply_to' => 'required|email:dns,rfc',
            'audience_id' => 'required',
            'send_at' => 'required',
            'preview_text' => 'required|string|max:255',
            'subject' => 'required|string|max:150',
            'message' => 'required',
        ]);

        DB::transaction(function () {
            // Save message with all properties
            $this->broadcast->save([
                'title' => $this->title,
                'reply_to' => $this->reply_to,
                'audience_id' => $this->audience,
                'send_at' => $this->send_at,
                'preview_text' => $this->preview,
                'subject' => $this->subject,
                'message' => $this->message,
            ]);
            // Queue the message for sending
            // TODO...
        });

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
