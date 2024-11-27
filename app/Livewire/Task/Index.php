<?php

namespace App\Livewire\Task;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $client;
    public $clientUsers = [];
    public $tasks;

    public $search = '';

    public function mount($client = null)
    {
        $user = Auth::user();

        if (!$client && $user->is_client) {
            $this->client = $user->ownedClient;
        } else {
            $this->client = Client::findOrFail($client);
        }

        $this->clientUsers = clientUsers($this->client);

        $this->tasks = $this->client->tasks;
    }

    public function render()
    {
        return view('livewire.task.index');
    }
}
