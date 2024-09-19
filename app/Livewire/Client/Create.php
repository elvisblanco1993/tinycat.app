<?php

namespace App\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $modal;

    #[Validate('required')]
    public $name;

    public function render()
    {
        return view('livewire.client.create');
    }

    public function save()
    {
        Auth::user()->currentTeam->clients()->create([
            'name' => $this->name,
        ]);

        $this->reset();
        $this->modal = false;
        $this->dispatch('client-added');
        $this->banner("Client added!");
    }
}
