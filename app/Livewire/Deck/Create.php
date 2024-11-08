<?php

namespace App\Livewire\Deck;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $modal;

    public Project $project;

    #[Validate('required', message: 'Please provide a name for this deck.')]
    public $name;

    public function render()
    {
        return view('livewire.deck.create');
    }

    public function save()
    {
        $this->validate();
        $this->project->decks()->create([
            'name' => $this->name,
            'order' => $this->project->decks->count() + 1,
        ]);

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
