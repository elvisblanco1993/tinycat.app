<?php

namespace App\Livewire\Form;

use App\Models\Form;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Update extends Component
{
    public $form;

    public $modal;

    public function mount(Form $form)
    {
        $this->form = $form;
        $this->authorize('update', $this->form);
    }

    public function render()
    {
        return view('livewire.form.update');
    }
}
