<?php

namespace App\Livewire\Form;

use App\Models\Form;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.form.index', [
            'forms' => Form::get(),
        ]);
    }
}
