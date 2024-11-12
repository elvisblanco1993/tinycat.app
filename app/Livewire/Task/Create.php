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

    public $due_date;

    public $description;

    public function render()
    {
        return view('livewire.task.create', [
            'options' => $this->users,
        ]);
    }

    public function save()
    {
        $assignees = collect($this->assign_to)->pluck('id');

        $task = $this->project->tasks()->create([
            'deck_id' => $this->project->decks()->firstOrCreate(['order' => 1], ['name' => 'Triage', 'order' => 1])->id,
            'created_by' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
        ]);

        $task->assignees()->attach($assignees);

        $this->redirect(url: url()->previous(), navigate: true);
    }

    public function getUsersProperty()
    {
        $team = Auth::user()->currentTeam;

        return User::select('id', 'name', 'profile_photo_path')
            ->where('current_team_id', $team->id)
            ->orWhereHas('ownedClient', function ($q) use ($team) {
                $q->where('team_id', $team->id);
            })
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'profile_photo_url' => $user->profile_photo_url,
                    'disabled' => false,
                ];
            })
            ->toArray();
    }
}
