<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadImageController extends Controller
{
    public function download(Gallery $image) {
        $path = Storage::path("public/". $image->path);
        // dd($path);
        $pathInfor = pathinfo("public/" . $image->path);
        $extension = $pathInfor["extension"];
        $newFileName = $image->name.'.'. $extension;
        return response()->download($path, $newFileName);
    }
}
