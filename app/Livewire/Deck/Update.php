<?php

namespace App\Livewire\Deck;

use App\Models\Deck;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    public $modal;

    public Deck $deck;

    #[Validate('required', message: 'Please provide a name for this deck.')]
    public $name;

    public $color;

    public function mount()
    {
        $this->name = $this->deck->name;
        $this->color = $this->deck->color;
    }

    public function render()
    {
        return view('livewire.deck.update');
    }

    public function save()
    {
        $this->validate();
        $this->deck->update([
            'name' => $this->name,
            'color' => $this->color,
        ]);
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
