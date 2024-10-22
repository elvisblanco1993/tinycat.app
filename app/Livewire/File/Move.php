<?php

namespace App\Livewire\File;

use App\Models\Item;
use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;

class Move extends Component
{
    public $modal;
    public $folders;
    public $client;
    public $items;
    public $currentItem;

    #[On('move-item')]
    public function showItemDrawer(Client $client, Item $item)
    {
        $this->client = $client;
        $this->currentItem = $item;
        $this->items = Item::where('client_id', $client->id)
            ->whereNull('parent_id')
            ->where('is_folder', 1)
            ->with('subdirectories')
            ->get();
        $this->modal = true;
    }

    public function render()
    {
        return view('livewire.file.move');
    }

    public function move($parent = null)
    {
        $this->currentItem->update(['parent_id' => $parent]);
        $this->redirect(url: route('client.files', ['client' => $this->client, 'item' => $parent]), navigate: true);
    }
}
