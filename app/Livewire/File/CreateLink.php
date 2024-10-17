<?php

namespace App\Livewire\File;

use App\Models\Item;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateLink extends Component
{
    public Client $client;
    public ?Item $parent = null;

    public $modal;

    public $name;
    public $path;

    public function render()
    {
        return view('livewire.file.create-link');
    }

    public function save()
    {
        $this->validate([
            'path' => ['required', 'active_url']
        ]);

        $this->client->items()->create([
            'team_id' => Auth::user()->currentTeam->id,
            'parent_id' => $this->parent?->id,
            'name' => $this->name ?? $this->path,
            'path' => $this->path,
            'is_external' => true,
        ]);

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
