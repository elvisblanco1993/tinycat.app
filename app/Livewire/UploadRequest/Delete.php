<?php

namespace App\Livewire\UploadRequest;

use App\Models\Client;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Delete extends Component
{
    public Request $request;

    public Client $client;

    public function mount()
    {
        $this->authorizeForUser(Auth::user(), 'delete', $this->request);
    }

    public function render()
    {
        return view('livewire.upload-request.delete');
    }

    public function delete()
    {
        $this->request->delete();
        session()->flash('flash.banner', 'Request successfully deleted.');
        $this->redirect(url: route('upload-request.index', ['client' => $this->client]), navigate: true);
    }
}
