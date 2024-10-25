<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Client $client;

    public $search = '';

    public $perPage = 10;

    public function render()
    {
        return view('livewire.upload-request.index', [
            'requests' => $this->requests,
        ]);
    }

    public function getRequestsProperty()
    {
        return $this->client->requests()
            ->where('ulid', 'like', "%$this->search%")
            ->paginate($this->perPage);
    }
}
