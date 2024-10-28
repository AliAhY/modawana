<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        if ($comment->profile_id !== Auth::user()->profile->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->comment = $request->input('comment');
        $comment->save();

        return response()->json(['success' => 'Comment updated successfully']);
    }
}
