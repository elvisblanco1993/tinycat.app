<?php

namespace App\Livewire\Audience;

use App\Models\Audience;
use Livewire\Component;

class Update extends Component
{
    public Audience $audience;

    public $modal;

    public $name;

    public function mount()
    {
        $this->fill($this->audience->only('name'));
    }

    public function render()
    {
        return view('livewire.audience.update');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string'
        ]);

        $this->audience->update(['name' => $this->name]);

        session()->flash('flash.banner', 'Audience updated!');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
