<?php

namespace App\Livewire\Audience;

use App\Models\Audience;
use Livewire\Component;

class Delete extends Component
{
    public Audience $audience;

    public function render()
    {
        return view('livewire.audience.delete');
    }

    public function delete()
    {
        $this->audience->delete();
        session()->flash('flash.banner', 'Audience deleted!');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url: route('audience.index'), navigate: true);
    }
}
