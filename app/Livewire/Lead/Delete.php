<?php

namespace App\Livewire\Lead;

use App\Models\Lead;
use Livewire\Component;
use Livewire\Attributes\On;

class Delete extends Component
{
    public $selected = [];

    public function render()
    {
        return view('livewire.lead.delete');
    }

    public function delete()
    {
        Lead::whereIn('id', $this->selected)->delete();
        $this->redirect(url: route('lead.index'), navigate: true);
    }

    #[On('update-selection')]
    public function getSelection($selection)
    {
        $this->selected = $selection;
    }
}
