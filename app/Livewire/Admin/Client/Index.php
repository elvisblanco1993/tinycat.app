<?php

namespace App\Livewire\Admin\Client;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $per_page = 25;

    public $selected = [];

    public $select_page = false;

    public $select_all = false;

    public function mount()
    {
        $this->authorize('viewAny', Client::class);
    }

    #[On('client-added')]
    public function render()
    {
        return view('livewire.admin.client.index', [
            'clients' => $this->clients,
        ]);
    }

    #[Renderless]
    public function updatedSelectPage($value)
    {
        $this->selected = $value
            ? $this->clients->pluck('id')
            : [];

        $this->select_all = $this->clients->count() < $this->clients->total() ? false : true;

        $this->dispatch('update-selection', selection: $this->selected);
    }

    public function selectAll()
    {
        $this->dispatch('update-selection', selection: Client::pluck('id'));
        $this->select_all = true;
    }

    public function updatedSelected()
    {
        $this->dispatch('update-selection', selection: $this->selected);
        $this->select_all = false;
        $this->select_page = false;
    }

    public function getClientsProperty()
    {
        return Client::search($this->search)->paginate($this->per_page);
    }
}
