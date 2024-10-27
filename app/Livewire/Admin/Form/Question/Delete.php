<?php

namespace App\Livewire\Admin\Form\Question;

use App\Models\Question;
use Livewire\Component;

class Delete extends Component
{
    public Question $question;

    public function render()
    {
        return view('livewire.admin.form.question.delete');
    }

    public function delete()
    {
        $this->question->delete();
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
