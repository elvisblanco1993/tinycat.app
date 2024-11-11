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

    public $is_expanded;

    public function mount()
    {
        $this->name = $this->deck->name;
        $this->is_expanded = $this->deck->is_expanded;
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
            'is_expanded' => $this->is_expanded,
            'color' => $this->color,
        ]);
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
