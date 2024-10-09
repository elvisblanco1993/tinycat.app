<?php

namespace App\Livewire\Form\Question;

use App\Models\Form;
use App\Models\Question;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Index extends Component
{
    public Form $form;

    public function render()
    {
        return view('livewire.form.question.index', [
            'questions' => $this->form->questions,
        ]);
    }

    #[Renderless]
    public function updateOrder($questions)
    {
        foreach ($questions as $question) {
            try {
                Question::findOrFail($question['value'])->update(['order' => $question['order']]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}
