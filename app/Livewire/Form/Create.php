<?php

namespace App\Livewire\Form;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

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
            'slug' => Str::random(12),
        ]);

        $this->redirect(url: route('form.show', ['form' => $form]), navigate: true);
    }
}
