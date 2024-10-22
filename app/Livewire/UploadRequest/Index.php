<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use Livewire\Component;

class Index extends Component
{
    public Client $client;

    public function render()
    {
        return view('livewire.upload-request.index', [
            'requests' => $this->client->requests
        ]);
    }
}
