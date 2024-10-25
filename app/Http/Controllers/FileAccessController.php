<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class FileAccessController extends Controller
{
    public function downloadThumbnail(Item $item)
    {
        return Storage::download($item->thumbnail);
    }

    /**
     * Download file with a signed URL.
     *
     * @return url
     */
    public function downloadPrivately(Item $item)
    {
        $signedUrl = Storage::temporaryUrl($item->path, now()->addMinutes(10));

        return redirect($signedUrl);
    }
}
