<?php

namespace App\Livewire\Admin\Form;

use App\Models\Form;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.form.index', [
            'forms' => Form::get(),
        ]);
    }
}
