<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $client;

    public Request $request;

    public function mount($client = null)
    {
        $user = Auth::user();
        if (! $client && $user->is_client) {
            $this->client = $user->ownedClient;
        } else {
            $this->client = Client::where('id', $client)->firstOrFail();
        }
    }

    public function render()
    {
        return view('livewire.upload-request.show');
    }
}
