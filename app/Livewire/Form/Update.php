<?php

namespace App\Livewire\Form;

use App\Models\Form;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Update extends Component
{
    use InteractsWithBanner;

    public Form $form;

    public $modal;

    public $title;

    public $slug;

    public $heading;

    public $subheading;

    public $status;

    public function mount()
    {
        $this->authorize('update', $this->form);

        $this->title = $this->form->title;
        $this->slug = $this->form->slug;
        $this->heading = $this->form->heading;
        $this->subheading = $this->form->subheading;
        $this->status = $this->form->status;
    }

    public function render()
    {
        return view('livewire.form.update');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required|in:DRAFT,PUBLISHED,CLOSED',
        ]);

        $this->form->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
        ]);

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
