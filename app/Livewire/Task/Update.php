<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;

class Update extends Component
{
    public Task $task;

    public $drawer;

    public $title;
    public $description;
    public $assign_to = [];
    public $recipients =[];

    public $clientUsers;

    public function mount()
    {
        $this->task = Task::make(); // Initialize with an empty task to prevent visual glitches.
    }

    #[On('update-task')]
    public function loadTask(Task $task)
    {
        $this->task = $task;
        $this->fill($this->task->only([
            'title',
            'description',
            'priority',
            'status',
            'due_date',
            'progress',
        ]));
        $this->assign_to = $this->task->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'profile_photo_url' => $user->profile_photo_url,
                'disabled' => false,
            ];
        })->toArray();
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
