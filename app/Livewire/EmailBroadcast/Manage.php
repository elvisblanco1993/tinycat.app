<?php

namespace App\Livewire\EmailBroadcast;

use Livewire\Component;
use App\Models\Audience;
use App\Models\EmailBroadcast;
use Illuminate\Support\Facades\DB;

class Manage extends Component
{
    public EmailBroadcast $broadcast;
    public $title;
    public $reply_to;
    public $audience_id;
    public $audience_list = [];
    public $subject;
    public $preview;
    public $message;
    public $send_at;

    public function mount()
    {
        $this->authorize('create', EmailBroadcast::class);
        $this->fill($this->broadcast->toArray());
        $this->audience_list = Audience::get();
    }

    public function render()
    {
        return view('livewire.email-broadcast.manage');
    }

    public function save()
    {
        $this->broadcast->update([
            'title' => $this->title,
            'reply_to' => $this->reply_to,
            'audience_id' => $this->audience_id,
            'send_at' => $this->send_at,
            'preview' => $this->preview,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->dispatch('saved');
    }

    public function send()
    {
        $this->validate([
            'reply_to' => 'required|email:dns,rfc',
            'audience_id' => 'required',
            'send_at' => 'required',
            'preview' => 'required|string|max:255',
            'subject' => 'required|string|max:150',
            'message' => 'required',
        ], [
            'reply_to' => 'You must set a reply address',
            'audience_id' => 'You must select an audience or create one if none exists.'
        ]);

        $this->save();

        // Send the email
    }
}
