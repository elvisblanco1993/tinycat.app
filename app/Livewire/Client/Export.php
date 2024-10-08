<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Exports\ClientExport;
use Maatwebsite\Excel\Facades\Excel;

class Export extends Component
{
    public $selected;

    public function render()
    {
        return view('livewire.client.export');
    }

    public function export()
    {
        $clients = Client::whereIn('id', $this->selected)->get();
        return Excel::download(new ClientExport($clients), 'clients.xlsx');
    }

    #[On('update-selection')]
    public function getSelection($selection)
    {
        $this->selected = $selection;
    }
}
