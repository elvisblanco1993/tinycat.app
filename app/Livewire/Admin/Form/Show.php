<?php

namespace App\Livewire\Admin\Form;

use App\Models\Form;
use Livewire\Component;

class Show extends Component
{
    public Form $form;

    public function render()
    {
        return view('livewire.admin.form.show');
    }
}
