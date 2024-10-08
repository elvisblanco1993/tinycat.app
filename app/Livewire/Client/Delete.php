<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;

class Delete extends Component
{
    public $selected = [];

    public function render()
    {
        return view('livewire.client.delete');
    }

    public function delete()
    {
        Client::whereIn('id', $this->selected)->delete();
        $this->redirect(url: route('client.index'), navigate: true);
    }

    #[On('update-selection')]
    public function getSelection($selection)
    {
        $this->selected = $selection;
    }
}
