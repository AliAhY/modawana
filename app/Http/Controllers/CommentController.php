<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $post = Post::find($request->input('post_id'));
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found!');
        }

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->profile_id = Auth::user()->profile->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
