<?php

namespace App\Livewire\File;

use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    public $drawer;

    public $item;

    public $name;

    #[On('show-item')]
    public function showItemDrawer(Item $id)
    {
        $this->item = $id;
        $this->name = $this->item->name;
        $this->drawer = true;
    }

    public function render()
    {
        return view('livewire.file.update');
    }

    public function updateName()
    {
        $this->item->update(['name' => $this->name]);
        $this->dispatch('saved-name');
        $this->dispatch('updated-item')->to(\App\Livewire\File\Index::class);
    }

    /**
     * Unset item upon closing the drawer
     */
    public function updatedDrawer()
    {
        if ($this->drawer == false) {
            $this->item = null;
            $this->reset('item');
        }
    }
}
