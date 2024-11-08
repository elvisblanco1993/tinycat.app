<?php

namespace App\Livewire\Project;

use App\Enums\ProjectStatuses;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $modal;

    public $team_id;

    public $client_id;

    #[Validate(rule: 'required', message: 'Please name the project.')]
    public $name;

    public $description;

    public $start_date;

    public $end_date;

    public $status;

    public function mount()
    {
        $this->authorizeForUser(Auth::user(), 'create', Project::class);
    }

    public function render()
    {
        return view('livewire.project.create');
    }

    public function save()
    {
        $this->validate();

        $user = Auth::user();

        $project = $user->currentTeam->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => ProjectStatuses::NOT_STARTED,
        ]);

        $project->decks()->createMany([
            ['name' => 'Pending', 'order' => 1],
            ['name' => 'In progress', 'order' => 2],
            ['name' => 'Waiting for client', 'order' => 3],
            ['name' => 'Done', 'order' => 4],
        ]);

        $this->redirect(url: route('project.show', ['project' => $project]), navigate: true);
    }
}
