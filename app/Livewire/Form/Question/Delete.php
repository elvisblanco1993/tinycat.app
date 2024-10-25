<?php

namespace App\Livewire\Form\Question;

use App\Models\Question;
use Livewire\Component;

class Delete extends Component
{
    public Question $question;

    public function render()
    {
        return view('livewire.form.question.delete');
    }

    public function delete()
    {
        $this->question->delete();
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
