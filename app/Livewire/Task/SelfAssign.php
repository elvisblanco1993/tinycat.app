<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SelfAssign extends Component
{
    public Task $task;

    public function render()
    {
        return view('livewire.task.self-assign');
    }

    public function assign()
    {
        $this->task->users()->attach(Auth::id());
        $this->dispatch('decks:refresh');
    }
}
