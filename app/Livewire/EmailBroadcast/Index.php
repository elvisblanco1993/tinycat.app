<?php

namespace App\Livewire\EmailBroadcast;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.email-broadcast.index', [
            'emails' => $this->emails
        ]);
    }

    public function getEmailsProperty()
    {
        return Auth::user()->currentTeam->email_broadcasts()->paginate(15);
    }
}
