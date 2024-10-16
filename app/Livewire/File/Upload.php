<?php

namespace App\Livewire\File;

use App\Models\Item;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class Upload extends Component
{
    use WithFileUploads;

    public Client $client;
    public ?Item $parent = null;

    public $modal;

    #[Validate(['files' => 'required'])]
    #[Validate(['files.*' => 'mimes:pdf,jpeg,jpg,png,gif,webp|max:102400'])]
    public $files = [];

    public $supported = [];

    public function mount()
    {
        $this->supported = json_encode(['image/png', 'image/jpg', 'image/jpeg', 'image/webp', 'application/pdf']);
    }

    public function render()
    {
        return view('livewire.file.upload');
    }

    public function save()
    {
        $this->validate();
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
                if (str_starts_with($mime, 'image/')) {
                    $thumbnail = $this->generateImageThumbnail($filepath, $thumbpath);
                }

                Item::create([
                    'team_id' => Auth::id(),
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
        if (!Storage::exists($thumbpath)) {
            Storage::makeDirectory($thumbpath);
        }
        $thumb = Image::read(Storage::path($filepath))->scale(width: 150);
        $thumbnailName = basename($filepath, '.' . pathinfo($filepath, PATHINFO_EXTENSION)) . '.webp';
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
