<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $year = Carbon::now()->year;

        if ($user->id == auth()->user()->id) {
            $images = Gallery::where('user_id', $user->id)->latest()->paginate(15);
        } else {
            $images = Gallery::where('user_id', $user->id)->where('status', 1)->latest()->paginate(15);
        }
        $imagesCount = Gallery::where('user_id', $user->id)->count();
        $conImg = true;
        if ($imagesCount < 15 || $images->isEmpty()) {
            $conImg = false;
        }
        $year = Carbon::now()->year;
        return view("user.profile", compact("user", "year", "conImg", "images"));
    }
    public function profileImage(User $user, Gallery $image)
    {
        // dd($image);
        if (!$image->status) {
            if (auth()->user()->level !== 'admin' && $user->id !== auth()->user()->id) {
                abort(404);
            }
        }
        $comments = $image->comment;
        return view('user.detail-image', compact("image", "comments", "user"));
    }

    public function edit(User $user)
    {
        $this->authorize('auth.user', $user);
        return view('user.settings-account-management', compact("user"));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('auth.user', $user);
        $validated = $request->validate([
            'description' => 'nullable|min:1|max:300',
            'photo' => 'nullable|image|max:2048',
            'instagram' => 'nullable|active_url',
            'twitter' => 'nullable|active_url',
            'facebook' => 'nullable|active_url',
        ]);
        $profile = $user->profile;
        $validated['user_id'] = $user->id;
        // dd($request->hasFile('photo'));
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $photo = $request->file('photo');
            $photoName = time() . '-' . $user->username . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('profile', $photoName, 'public');
            $validated['photo'] = $path;
        }
        $profile->update($validated);
        return redirect()->route('user.show', auth()->user())->with('success', 'succesfully update account');
    }
}
