<?php

namespace App\Livewire\UploadRequest;

use App\Mail\UploadRequestCompleted;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Attributes\Validate;
use Livewire\Component;
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
        $this->validate();
        $basepath = "filesystem/client/{$this->request->client_id}";
        $thumbpath = "filesystem/client/{$this->request->client_id}/thumbnails";

        try {
            DB::transaction(function () use ($basepath, $thumbpath) {
                foreach ($this->files as $file) {
                    $fileExtension = $file->getClientOriginalExtension();
                    $filepath = $file->storeAs(
                        $basepath,
                        str()->uuid().'.'.$fileExtension
                    );
                    $mime = $file->getMimeType();

                    // Generates a thumbnail
                    $thumbnail = null;
                    if (
                        str_starts_with($mime, 'image/') &&
                        $mime !== 'image/svg+xml'
                    ) {
                        $thumbnail = $this->generateImageThumbnail(
                            $filepath,
                            $thumbpath
                        );
                    }

                    $this->request->files()->create([
                        'team_id' => $this->request->team_id,
                        'client_id' => $this->request->client_id,
                        'parent_id' => $this->request->item_id,
                        'name' => $file->getClientOriginalName(),
                        'is_folder' => 0,
                        'path' => $filepath,
                        'thumbnail' => $thumbnail,
                        'mime' => $file->getMimeType(),
                        'size' => $file->getSize(),
                    ]);
                }

                $this->request->update([
                    'completed_at' => now(),
                    'completed_by' => Auth::id(),
                ]);

                // Send email to provider users
                Mail::to($this->request->team->allUsers())->queue(new UploadRequestCompleted($this->request));
            });

            session()->flash('flash.banner', 'Files successfully uploaded!');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'File upload failed! Please try again, or contact support for assistance');
            session()->flash('flash.bannerStyle', 'danger');
        }
        $this->redirect(url: url()->previous(), navigate: true);
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
}
