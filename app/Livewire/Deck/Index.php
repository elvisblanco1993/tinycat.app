<?php

namespace App\Livewire\Deck;

use App\Models\Deck;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Renderless;

class Index extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.deck.index', [
            'decks' => $this->project->decks()->with('tasks')->orderBy('order')->get(),
        ]);
    }

    #[Renderless]
    public function updateOrder($decks)
    {
        foreach ($decks as $deck) {
            try {
                Deck::findOrFail($deck['value'])
                    ->update([
                        'order' => $deck['order'],
                    ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
