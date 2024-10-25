<?php

namespace App\Livewire\File;

use App\Models\Client;
use App\Models\Item;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public Client $client;

    public ?Item $item = null;

    public $search = '';

    #[On('updated-item')]
    public function render()
    {
        return view('livewire.file.index', [
            'items' => $this->items,
        ]);
    }

    // Get Items
    public function getItemsProperty()
    {
        $items = ($this->item && $this->item->is_folder)
            ? $this->item->children()
            : $this->client->items()->whereNull('parent_id');

        return $items->where('name', 'like', "%$this->search%")
            ->orderBy('is_folder', 'desc')
            ->orderBy('is_external', 'asc')
            ->orderBy('name', 'asc')
            ->get();
    }
}
