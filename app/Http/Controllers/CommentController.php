<?php

namespace App\Http\Controllers;

use App\Models\Comment_log;
use App\Models\Gallery;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,Gallery $image) {
        $validated = $request->validate([
            'comment'=> 'required|min:1'
        ]);
        $validated['gallery_id']= $image->id;
        $validated['user_id']= auth()->user()->id;
        Comment_log::create($validated);
        return redirect()->back();
    }
    public function destroy(Comment_log $comment) {
        $comment->delete();
        return redirect()->back();
    }
}
