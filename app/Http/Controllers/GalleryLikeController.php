<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryLikeController extends Controller
{
    public function like(Gallery $image){
        // dd($image);
        $liker = auth()->user();
        $liker->likes()->attach($image);
        return redirect()->back();
    }
    public function unlike(Gallery $image)
    {
        // dd($image);

        $liker = auth()->user();
        $liker->likes()->detach($image);
        return redirect()->back();
    }
}
