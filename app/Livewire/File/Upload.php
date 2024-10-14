<?php

namespace App\Livewire\File;

use App\Models\Client;
use Livewire\Component;

class Upload extends Component
{
    public Client $client;
    public $modal;

    public function render()
    {
        return view('livewire.file.upload');
    }
}
