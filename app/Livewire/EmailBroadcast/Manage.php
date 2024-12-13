<?php

namespace App\Livewire\EmailBroadcast;

use Livewire\Component;
use App\Models\Audience;
use App\Models\EmailBroadcast;

class Manage extends Component
{
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
}
