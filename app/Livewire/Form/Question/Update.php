<?php

namespace App\Livewire\Form\Question;

use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\Renderless;

class Update extends Component
{
    public Question $question;

    public $question_text;
    public $placeholder;
    public $is_required;
    public $type;
    public $options;

    public function mount()
    {
        $this->question_text = $this->question->question_text;
        $this->placeholder = $this->question->placeholder;
        $this->is_required = $this->question->is_required;
        $this->type = $this->question->type;
        $this->options = $this->question->options ? implode(PHP_EOL, $this->question->options) : [];
    }

    public function render()
    {
        return view('livewire.form.question.update');
    }

    #[Renderless]
    public function updatedQuestionText()
    {
        $this->question->question_text = $this->question_text;
        $this->question->save();
    }

    #[Renderless]
    public function updatedPlaceholder()
    {
        $this->question->placeholder = $this->placeholder;
        $this->question->save();
    }

    #[Renderless]
    public function updatedIsRequired()
    {
        $this->question->is_required = $this->is_required;
        $this->question->save();
    }

    #[Renderless]
    public function updatedOptions()
    {
        $this->question->options = array_filter(explode(PHP_EOL, $this->options), fn($line) => trim($line) !== '');
        $this->question->save();
    }
}
