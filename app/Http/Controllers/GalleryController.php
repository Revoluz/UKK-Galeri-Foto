<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|min:1|max:50',
            'description' =>'nullable|max:300',
            'image' => 'required|image|dimensions:min_height=300',
        ]);
        // dd($validated);
        $file = $request->file('image');
        $name = time().'-'.$validated['name'].'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('gallery', $name,'public');

        Gallery::create([
            'name'=> $validated['name'],
            'description'=> $validated['description'],
            'path'=> $path,
            'user_id'=> auth()->user()->id
        ]);
        return redirect()->route('profile.index', auth()->user())->with('success','Success add new image');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $image)
    {
        if (!$image->status) {
            if (auth()->user()->level !== 'admin' && $image->user->id !== auth()->user()->id) {
                abort(404);
            }
        }
        $comments = $image->comment;
        return view('user.detail-image', compact("image","comments"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $image)
    {
        $this->authorize('auth.user', $image->user);
        $validated = $request->validate([
            'name'=>'required|min:1|max:50',
            'description' => 'nullable|max:300',
        ]);
        $image->update($validated);
        return redirect()->back()->with('success','succesfully update image');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $image)
    {
        $this->authorize('auth.user', $image->user);
        if(Storage::disk("public")->exists($image->path)) {
            Storage::disk("public")->delete($image->path);
        }
        $image->delete();
        return redirect()->route("profile.index", auth()->user())->with("success","delete image successfully");
    }
}
