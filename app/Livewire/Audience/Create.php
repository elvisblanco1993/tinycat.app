<?php

namespace App\Livewire\Audience;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $modal;
    public $name;

    public function render()
    {
        return view('livewire.audience.create');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string'
        ]);

        Auth::user()->currentTeam->audiences()->create([
            'name' => $this->name,
        ]);

        session()->flash('flash.banner', 'New audience created!');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
