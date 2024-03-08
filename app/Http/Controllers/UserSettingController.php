<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('auth.user', $user);
        return view('user.settings-show-profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('auth.user', $user);

        return view('user.settings-edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('auth.user', $user);

        $rules = [
            'name' => 'required|max:100|min:3',
            'username' => 'required|min:3|max:30|alpha_dash',
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ];
        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:30|alpha_dash|unique:users,username';
        }
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users,email';
        }
        $validated = $request->validate($rules);
        // dd($request->password== null);
        if($request->password == null){
            unset($validated['password']);
        }
        if ($request->username != $user->username) {
            $validated['slug'] = Str::slug($validated['username']);
        }
        $validated['user_id'] = $user->id;
        $user->update($validated);
        return redirect()->route('user.show',$user)->with('success','succeffully update profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('auth.user', $user);
        if ($user->galleries) {
            foreach ($user->galleries as $image) {
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
            }
        }
        if ($user->profile->photo ?? false) {
            if (Storage::disk('public')->exists($user->profile->photo)) {
                Storage::disk('public')->delete($user->profile->photo);
            }
        }
        $user->delete();
        return redirect()->route('login');
    }
}
