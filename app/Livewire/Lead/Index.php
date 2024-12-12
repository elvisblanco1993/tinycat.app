<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Renderless;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $per_page = 15;
    public $selected = [];
    public $select_page = false;
    public $select_all = false;

    public function mount()
    {
        $this->authorize('viewAny', Lead::class);
    }

    public function render()
    {
        return view('livewire.lead.index', [
            'leads' => $this->leads
        ]);
    }

    public function getLeadsProperty()
    {
        return Lead::search($this->search)
            ->query(fn() => $this->resetPage())
            ->paginate($this->per_page);
    }

    #[Renderless]
    public function updatedSelectPage($value)
    {
        $this->selected = $value
            ? $this->leads->modelKeys()
            : [];

        $this->select_all = $this->leads->count() < $this->leads->total() ? false : true;

        $this->dispatch('update-leads-selection', selection: $this->selected);
    }

    public function selectAll()
    {
        $this->dispatch('update-leads-selection', selection: Lead::get()->modelKeys());
        $this->select_all = true;
    }

    public function updatedSelected()
    {
        $this->dispatch('update-leads-selection', selection: $this->selected);
        $this->select_all = false;
        $this->select_page = false;
    }
}
