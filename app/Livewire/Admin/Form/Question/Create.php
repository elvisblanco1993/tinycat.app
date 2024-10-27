<?php

namespace App\Livewire\Admin\Form\Question;

use App\Enums\QuestionTypes;
use App\Models\Form;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public Form $form;

    public $types;

    public function mount()
    {
        $this->types = QuestionTypes::class;
    }

    public function render()
    {
        return view('livewire.admin.form.question.create');
    }

    public function save($type)
    {
        $this->form->questions()->create([
            'type' => $type,
            'question_text' => config("internal.question_types.{$type}.label"),
            'placeholder' => config("internal.question_types.{$type}.placeholder"),
            'is_required' => 1,
            'order' => $this->form->questions->count() + 1,
        ]);

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
