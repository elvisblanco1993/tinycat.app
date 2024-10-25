<?php

namespace App\Livewire\ItemTemplate;

use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public $modal = true;

    public $root_name;

    public Collection $inputs;

    protected $rules = [
        'root_name' => 'required',
        'inputs.*.text' => 'required',
    ];

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['text' => '']]),
        ]);
    }

    public function render()
    {
        return view('livewire.item-template.create');
    }

    public function save()
    {
        $this->validate();

        $subdirectories = serialize($this->inputs->pluck('text')->toArray());
    }

    public function addInput()
    {
        $this->inputs->push(['text' => '']);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }
}
