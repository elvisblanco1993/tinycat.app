<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $perPage = 10;

    public function render()
    {
        return view('livewire.project.index', [
            'projects' => $this->projects,
        ]);
    }

    public function getProjectsProperty()
    {
        return Project::search($this->search)->paginate($this->perPage);
    }
}
