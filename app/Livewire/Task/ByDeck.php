<?php

namespace App\Livewire\Task;

use Livewire\Component;

class ByDeck extends Component
{
    public $tasks;

    public function render()
    {
        return view('livewire.task.by-deck');
    }
}
