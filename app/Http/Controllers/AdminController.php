<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function traffic($year)
    {
        $data = Gallery::whereYear('created_at', $year)
            ->selectRaw('COUNT(*) as total,MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
            $month = [];
            $total = [];
        foreach ($data as $item) {
            $month[] = Carbon::parse('2024-'. $item->month . '-01')->format('F');
            $item->month = Carbon::parse('2024-' . $item->month .'-01')->format('F');
            $total[] = $item->total;
        }
        $years = Gallery::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');
        return view('admin.traffic', [
            'year' => $year,
            'month'=>$month,
            'total'=> $total,
            'years'=> $years,
            'data' => $data
        ]);
    }
    public function user(){
        $users = User::latest()->get();
        return view('admin.data-user',compact('users') );
    }
    public function userStore(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:100|min:3',
            'username' => 'required|min:3|max:30|alpha_dash|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'level' => 'required|in:user,admin'
        ]);
        $validated['slug'] = Str::slug($validated['username']);
        $user = User::create($validated);
        $user->profile()->create([
            'user_id' => $user->id,
        ]);
        return redirect()->route('dashboard.user')->with('success', 'successfully create account');
    }
    public function image(){
        $images = Gallery::all();
        return view('admin.data-image',compact('images'));
    }
    public function changeStatus(Gallery $image) {
        // dd($image);
        // dd( gettype($image));
        $image->status =!$image->status;
        $image->update();
        return redirect()->back()->with('success','Succesfully change image status');
    }
}
