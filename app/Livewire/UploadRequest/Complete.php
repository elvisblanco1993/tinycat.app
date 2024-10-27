<?php

namespace App\Livewire\UploadRequest;

use App\Models\Request;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Complete extends Component
{
    use WithFileUploads;

    public Request $request;

    #[Validate(['files' => 'required'])]
    #[Validate(['files.*' => 'max:102400'])]
    public $files = [];

    public $supported = [];

    public function mount()
    {
        $this->authorize('complete', $this->request);
        $this->supported = json_encode(config('mime_types'));
    }

    public function render()
    {
        return view('livewire.upload-request.complete');
    }

    public function save()
    {
        sleep(10);
        session()->flash('flash.banner', 'Request complete!');
        $this->redirect(url: url()->previous(), navigate: true);
    }
}
