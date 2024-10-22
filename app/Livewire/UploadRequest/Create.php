<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Create extends Component
{
    public Client $client;
    public $modal;
    public $message;

    public function render()
    {
        return view('livewire.upload-request.create');
    }

    public function save()
    {
        $this->client->requests()->create([
            'team_id' => Auth::user()->currentTeam->id,
            'item_id' => $this->client->items()->where('name', 'Uploads')->firstOrCreate(['name' => 'Uploads'], ['is_folder' => 1, 'team_id' => Auth::user()->currentTeam->id])->id, // The folder where files will be uploaded to.
            'message' => $this->message
        ]);

        // Send email to client

        // Return to previous URL
        session()->flash('banner', 'We have sent your request!');
        $this->redirect(url: url()->previous());
    }

    #[On('editorContentUpdated')]
    public function setMessage($content)
    {
        $this->message = $content;
    }
}
