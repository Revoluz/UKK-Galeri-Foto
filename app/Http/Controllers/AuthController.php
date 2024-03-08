<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|min:3',
            'username' => 'required|min:3|max:30|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        $validated['slug']=Str::slug($validated['username']);
        $user = User::create($validated);
        $user->profile()->create([
            'user_id'=>$user->id,
        ]);
        return redirect()->route('login')->with('success','successfully create account');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request) {
    $credentials= $request->validate([
        'username'=>'required|alpha_dash|min:3',
        'password'=>'required|min:8'
    ]);
    if (Auth::attempt($credentials)) {
        // create log
        $response = Http::get('https://api.ipify.org');
        // $ipAddress = $response->ok() ? $request->ip(): null;
        $ipAddress = $response->ok() ? $response->body(): null;
        // dd($ipAddress);
        $locationResponse = Http::get("http://ip-api.com/json/$ipAddress");
        $locationData = $locationResponse->json();
        // dd($locationData);
        $location = $locationData["city"];
        $chennelLog = Log::channel("login");
        $chennelLog->info("User login attempt: username = {username}, From {location}",['username'=>$credentials['username'],'location'=> $location]);
        // login seesion
        $request->session()->regenerate();
        return redirect()->route('explore')->with('success','login success');
        }
        return redirect()->route('login')->with('error','Login Failed');
    }
    public function logout(){
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

}
