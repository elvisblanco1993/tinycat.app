<?php

namespace App\Livewire\Audience;

use App\Models\Audience;
use Livewire\Component;

class Show extends Component
{
    public Audience $audience;
    public $leads;

    public function mount()
    {
        $this->audience->loadCount('leads')->load('leads');
        $this->leads = $this->audience->leads;
    }

    public function render()
    {
        return view('livewire.audience.show');
    }
}
