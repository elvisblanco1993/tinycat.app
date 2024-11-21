<?php

namespace App\Livewire\Deck;

use App\Models\Deck;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public Project $project;

    protected $listeners = ['decks:refresh' => 'refresh'];

    public function render()
    {
        return view('livewire.deck.index', [
            'decks' => $this->project->decks()->with(['tasks.creator', 'tasks.users'])->orderBy('order')->get(),
        ]);
    }

    #[Renderless]
    public function updateDeckOrder($decks)
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
        $this->dispatch('decks:refresh');
    }

    #[Renderless]
    public function updateTaskDeck($decks)
    {
        foreach ($decks as $deck) {
            $deckId = $deck['value'];
            foreach ($deck['items'] as $task) {
                Task::find($task['value'])->update(['deck_id' => $deckId]);
            }
        }
        $this->dispatch('decks:refresh');
    }
}
