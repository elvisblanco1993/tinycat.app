<?php

namespace App\Livewire\UploadRequest;

use App\Mail\UploadRequestSent;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public Client $client;

    public $modal;

    public $message;

    public $due_at;

    public function render()
    {
        return view('livewire.upload-request.create');
    }

    public function save()
    {
        $request = $this->client->requests()->create([
            'ulid' => Str::ulid(),
            'team_id' => Auth::user()->currentTeam->id,
            'item_id' => $this->client->items()->where('name', 'Uploads')->firstOrCreate(['name' => 'Uploads'], ['is_folder' => 1, 'team_id' => Auth::user()->currentTeam->id])->id, // The folder where files will be uploaded to.
            'due_at' => $this->due_at,
            'message' => $this->message,
        ]);

        // Send email to client
        Mail::to($this->client)->queue(new UploadRequestSent($request));

        // Return to previous URL
        session()->flash('flash.banner', 'We have sent your request!');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
