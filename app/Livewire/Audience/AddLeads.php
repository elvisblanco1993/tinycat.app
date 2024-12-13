<?php

namespace App\Livewire\Audience;

use App\Models\Lead;
use Livewire\Component;
use App\Models\Audience;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class AddLeads extends Component
{
    public $modal;

    public $selected = [];

    public $leads;
    public $audiences;

    public $audience;

    public function mount()
    {
        $this->audiences = Audience::get();
    }

    public function render()
    {
        return view('livewire.audience.add-leads');
    }

    public function save()
    {
        $this->validate([
            'audience' => 'required|exists:audiences,id',
        ]);

        try {
            Audience::findOrFail($this->audience)->leads()->syncWithoutDetaching($this->selected);
            session()->flash('flash.banner', 'The selected leads were added to the list.');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'Something went wrong. Please try again later.');
            session()->flash('flash.bannerStyle', 'danger');
        }

        $this->redirect(url: url()->previous(), navigate: true);
    }

    #[On('update-leads-selection')]
    public function getSelection($selection)
    {
        $this->selected = $selection;
        $this->leads = Lead::whereIn('id', $this->selected)->get();
    }
}
