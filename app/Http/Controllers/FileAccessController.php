<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class FileAccessController extends Controller
{
    public function serveThumbnail(Item $item)
    {
        return Storage::download($item->thumbnail);
    }
}
