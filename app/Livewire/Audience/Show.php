<?php

namespace App\Livewire\Audience;

use Livewire\Component;
use App\Models\Audience;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $search = '';

    public Audience $audience;

    public function mount()
    {
        $this->audience->load('leads');
    }

    public function render()
    {
        return view('livewire.audience.show', [
            'leads' => $this->leads,
        ]);
    }

    public function getLeadsProperty()
    {
        return $this->audience->leads()
            ->when($this->search, function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(15);
    }
}
