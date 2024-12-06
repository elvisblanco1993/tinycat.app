<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Notifications\TaskCompletedNotification;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;

class Update extends Component
{
    public Task $task;

    public $drawer;

    public $title;
    public $description;
    public $progress;
    public $priority;
    public $status;
    public $due_date;
    public $assign_to = [];
    public $subscribers =[];

    public $clientUsers;
    public $teamUsers;
    public $hasChanges;

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
        $this->subscribers = $this->task->subscribers->map(function ($user) {
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
        $this->validate([
            'title' => 'required',
        ]);
        $this->task->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->dispatch('saved');
    }

    public function setStatus($option)
    {
        $this->task->update(['status' => $option]);
        $this->status = $option;
        $this->dispatch('saved');
        if ($option === 'completed') {
            $this->task->subscribers->each->notify(new TaskCompletedNotification($this->task));
        }
    }

    public function setPriority($option)
    {
        $this->task->update(['priority' => $option]);
        $this->priority = $option;
        $this->dispatch('saved');
    }

    public function updatedDueDate()
    {
        $this->task->update(['due_date' => $this->due_date]);
        $this->dispatch('saved');
    }

    public function updatedSubscribers()
    {
        $this->task->subscribers()->sync(
            array_map(fn($subscriber) => $subscriber['id'], $this->subscribers)
        );
    }
}
