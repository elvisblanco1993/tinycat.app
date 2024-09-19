<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $selectPage = false;

    public $selected = [];

    #[On('client-added')]
    public function render()
    {
        return view('livewire.client.index', [
            'clients' => $this->clients,
        ]);
    }

    public function updatedSelectPage($value)
    {
        $this->selected = $value
            ? $this->clients->pluck('id')
            : [];
    }

    public function getClientsProperty()
    {
        return Client::search($this->search)->paginate(15);
    }
}
