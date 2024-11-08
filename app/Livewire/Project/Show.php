<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class Show extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.project.show');
    }
}
