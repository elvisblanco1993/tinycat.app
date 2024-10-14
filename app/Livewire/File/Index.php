<?php

namespace App\Livewire\File;

use App\Models\Item;
use App\Models\Client;
use Livewire\Component;

class Index extends Component
{
    public Client $client;
    public ?Item $item = null;
    public $search = '';

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

        return $items->where('name', 'like', "%$this->search%")->orderBy('is_folder', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }
}
