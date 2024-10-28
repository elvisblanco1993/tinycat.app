<?php

namespace App\Livewire\File;

use App\Models\Client;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public Client $client;

    public ?Item $parent = null;

    public $modal;

    #[Validate(['files' => 'required'])]
    #[Validate(['files.*' => 'max:102400'])]
    public $files = [];

    public $supported = [];

    public function mount()
    {
        $this->supported = json_encode(config('mime_types'));
    }

    public function render()
    {
        return view('livewire.file.upload');
    }

    public function save()
    {
        $this->validate();
        $team_id = Auth::user()->is_client ? $this->client->team_id : Auth::user()->current_team_id;
        // Attachments will always be saved under the lead folder in storage.
        // Each lead folder can be identified by the lead's ID number.
        $basepath = "filesystem/client/{$this->client->id}";
        $thumbpath = "filesystem/client/{$this->client->id}/thumbnails";

        try {
            foreach ($this->files as $file) {
                $fileExtension = $file->getClientOriginalExtension();
                $filepath = $file->storeAs($basepath, str()->uuid().'.'.$fileExtension);
                $mime = $file->getMimeType();

                // Generates a thumbnail
                $thumbnail = null;
                if (str_starts_with($mime, 'image/') && $mime !== 'image/svg+xml') {
                    $thumbnail = $this->generateImageThumbnail($filepath, $thumbpath);
                }

                $this->client->items()->create([
                    'team_id' => $team_id,
                    'client_id' => $this->client?->id,
                    'parent_id' => $this->parent?->id,
                    'name' => $file->getClientOriginalName(),
                    'is_folder' => 0,
                    'path' => $filepath,
                    'thumbnail' => $thumbnail,
                    'mime' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
            session()->flash('flash.banner', 'Files successfully uploaded!');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'File upload failed! Please try again, or contact support for assistance');
            session()->flash('flash.bannerStyle', 'danger');
        }

        $this->redirect(url: url()->previous(), navigate: false);
    }

    /**
     * Generates a thumbnail for an image
     */
    protected function generateImageThumbnail($filepath, $thumbpath)
    {
        if (! Storage::exists($thumbpath)) {
            Storage::makeDirectory($thumbpath);
        }
        $thumb = Image::read(Storage::path($filepath))->scale(width: 150);
        $thumbnailName = basename($filepath, '.'.pathinfo($filepath, PATHINFO_EXTENSION)).'.webp';
        $thumbnailPath = "{$thumbpath}/{$thumbnailName}";
        $thumb->toWebp()->save(Storage::path($thumbnailPath));

        return $thumbnailPath;
    }

    /**
     * Generates a thumbnail for a video
     */
    protected function generateVideoThumbnail($file)
    {
        //
    }

    /**
     * Generates a thumbnail for a PDF document
     */
    protected function generatePdfThumbnail($file)
    {
        //
    }
}
