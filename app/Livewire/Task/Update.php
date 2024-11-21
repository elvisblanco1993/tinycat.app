<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;

class Update extends Component
{
    public Task $task;

    public $drawer;

    public $title;
    public $assign_to = [];

    public $teamUsers = [];

    public $decks = [];

    public $selected_deck;

    public function mount()
    {
        $this->task = Task::make(); // Initialize with an empty task to prevent visual glitches.
    }

    #[On('update-task')]
    public function loadTask(Task $task)
    {
        $this->task = $task;
        $this->title = $this->task->title;
        $this->assign_to = $this->task->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'profile_photo_url' => $user->profile_photo_url,
                'disabled' => false,
            ];
        })->toArray();
        $this->teamUsers = teamUsers();
        $this->decks = $this->task->project->decks;
        $this->selected_deck = $this->task->deck->id;
        $this->drawer = true;
    }

    public function render()
    {
        return view('livewire.task.update');
    }

    public function save()
    {
        //
    }
}
