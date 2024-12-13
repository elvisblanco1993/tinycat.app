<?php

namespace App\Livewire\EmailBroadcast;

use App\Models\EmailBroadcast;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.email-broadcast.create');
    }

    public function save()
    {
        $team = Auth::user()->currentTeam;
        $broadcast = $team->email_broadcasts()->create([
            'title' => 'Untitled',
        ]);

        $this->redirect(url: route('broadcast.manage', ['emailBroadcast' => $broadcast->id]), navigate: true);
    }
}
