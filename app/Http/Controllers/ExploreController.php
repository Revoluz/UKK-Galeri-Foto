<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExploreController extends Controller
{
    public function explore()
    {
        $images = Gallery::where('status', 1)->inRandomOrder()->paginate(20);
        $conImg = true;
        return view('user.explore', compact('images', 'conImg'));
    }
    public function search(Request $request)
    {
        $search = $request->input('keyword');
        $chennelLog = Log::channel('search');
        $chennelLog->info("User searched for {keyword}" ,['keyword' => $search]);
        $images = Gallery::where('status', 1)->where('name', 'like', '%' . $search . '%')->paginate(15);
        $countImage = Gallery::where('status', 1)->where('name', 'like', '%' . $search . '%')->count();
        $conImg = true;
        if ($countImage <= 15 || $images->isEmpty()) {
            $conImg = false;
        }
        return view('user.explore', compact('conImg', 'images'));
    }
}
