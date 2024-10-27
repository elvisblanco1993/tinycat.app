<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $client;

    public $search = '';

    public $perPage = 10;

    public function mount($client = null)
    {
        $user = Auth::user();
        if (!$client && $user->is_client) {
            $this->client = $user->ownedClient;
        } else {
            $this->client = Client::where('id', $client)->firstOrFail();
        }
    }

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
