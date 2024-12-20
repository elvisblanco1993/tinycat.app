<?php

namespace App\Livewire\Lead;

use Livewire\Component;
use App\Imports\LeadImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;

    public $file;

    public $modal;

    public function render()
    {
        return view('livewire.lead.import');
    }

    public function import()
    {
        $fileToImportFrom = $this->file->store('imports');
        $team_id = Auth::user()->currentTeam->id;

        Excel::queueImport(new LeadImport($team_id), Storage::path($fileToImportFrom))
            ->afterResponse(
                Storage::delete($fileToImportFrom)
            );

        session()->flash('flash.banner', 'Import in progress. Refresh the page in a few seconds to view your leads.');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url: url()->previous());
    }
}
