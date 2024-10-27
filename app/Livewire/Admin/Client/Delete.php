<?php

namespace App\Livewire\Admin\Client;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $selected = [];

    public function render()
    {
        return view('livewire.admin.client.delete');
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
