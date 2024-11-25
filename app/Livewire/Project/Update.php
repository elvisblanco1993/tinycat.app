<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class Update extends Component
{
    public Project $project;

    public $name;
    public $description;
    public $start_date;
    public $end_date;
    public $assign_to = [];
    public $teamUsers;
    public $projectUsers;
    public $modal;

    public function mount()
    {
        $this->authorize('update', $this->project);
        $this->fill($this->project->only([
            'name',
            'description',
            'start_date',
            'end_date',
        ]));

        $this->assign_to = $this->projectUsers;
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

        $this->project->users()->sync(
            collect($this->assign_to)->pluck('id')
        );

        session()->flash('flash.banner', 'Project details updated.');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
