<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Imports\ClientImport;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class Import extends Component
{
    use WithFileUploads;

    public $file;

    public $modal;

    public function render()
    {
        return view('livewire.client.import');
    }

    public function import()
    {
        $fileToImportFrom = $this->file->store('imports');
        $team_id = Auth::user()->currentTeam->id;

        Excel::queueImport(new ClientImport($team_id), Storage::path($fileToImportFrom))
            ->afterResponse(
                Storage::delete($fileToImportFrom)
            );
    }
}
