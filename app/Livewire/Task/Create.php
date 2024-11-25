<?php

namespace App\Livewire\Task;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public Project $project;

    public $modal;

    public $title;

    public $assign_to = [];

    public $teamUsers;

    public $due_date;

    public $description;

    public function render()
    {
        return view('livewire.task.create');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
        ]);

        $users = collect($this->assign_to)->pluck('id');

        $task = $this->project->tasks()->create([
            'deck_id' => $this->project->decks()->firstOrCreate(['order' => 1], ['name' => 'Triage', 'order' => 1])->id,
            'created_by' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
        ]);

        $task->users()->attach($users);

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
