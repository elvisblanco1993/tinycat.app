<?php

namespace App\Livewire\File;

use App\Models\Client;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewFolder extends Component
{
    public $modal;

    public Client $client;

    public ?Item $parent = null;

    #[Validate('required')]
    public $name;

    public function render()
    {
        return view('livewire.file.new-folder');
    }

    public function save()
    {
        $this->validate();

        $this->client->items()->create([
            'team_id' => Auth::user()->currentTeam->id,
            'parent_id' => $this->parent?->id,
            'name' => $this->name,
            'is_folder' => true,
        ]);

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
