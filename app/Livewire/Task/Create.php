<?php

namespace App\Livewire\Task;

use App\Models\Project;
use Livewire\Component;

class Create extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.task.create');
    }
}
