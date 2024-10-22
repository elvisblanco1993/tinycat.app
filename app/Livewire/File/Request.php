<?php

namespace App\Livewire\File;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Request extends Component
{
    public Client $client;
    public $modal;
    public $message;
    public $directory;

    public function render()
    {
        return view('livewire.file.request');
    }

    // #[Renderless]
    #[On('editorContentUpdated')]
    public function setMessage($content)
    {
        $this->message = $content;
    }
}
