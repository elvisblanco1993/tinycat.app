<?php

namespace App\Livewire\Form;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public function render()
    {
        return view('livewire.form.create');
    }

    public function save()
    {
        $form = Auth::user()->currentTeam->forms()->create([
            'title' => 'New form',
            'slug' => Str::uuid()
        ]);

        $this->redirect(url: route('form.show', ['form' => $form]), navigate: true);
    }
}
