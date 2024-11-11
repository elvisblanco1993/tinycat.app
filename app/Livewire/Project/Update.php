<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class Update extends Component
{
    public Project $project;

    #[Url]
    public $navigate = 'details';

    public $name;

    public $description;

    public $start_date;

    public $end_date;

    public function mount()
    {
        $this->authorize('update', $this->project);
        $this->fill($this->project->only([
            'name',
            'description',
            'start_date',
            'end_date',
        ]));
    }

    public function render()
    {
        return view('livewire.project.update');
    }

    public function save()
    {
        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->dispatch('saved');
    }
}
