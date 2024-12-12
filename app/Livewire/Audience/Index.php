<?php

namespace App\Livewire\Audience;

use Livewire\Component;
use App\Models\Audience;

class Index extends Component
{
    public function render()
    {
        return view('livewire.audience.index', [
            'audiences' => Audience::withCount('leads')->get(),
        ]);
    }
}
