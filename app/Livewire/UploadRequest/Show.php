<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use App\Models\Request;
use Livewire\Component;

class Show extends Component
{
    public Client $client;

    public Request $request;

    public function render()
    {
        return view('livewire.upload-request.show');
    }
}
