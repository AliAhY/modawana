<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
        ]);

        // تحقق مما إذا كان السجل موجودًا بالفعل  
        $likeExists = CommentLike::where('comment_id', $commentId)
            ->where('profile_id', $request->profile_id)
            ->exists();

        if (!$likeExists) {
            CommentLike::create([
                'comment_id' => $commentId,
                'profile_id' => $request->profile_id,
            ]);
            return response()->json(['success' => true, 'message' => 'Liked successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'You have already liked this comment.']);
    }

    public function destroy(Request $request, $commentId)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
        ]);

        CommentLike::where('comment_id', $commentId)
            ->where('profile_id', $request->profile_id)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Unliked successfully.']);
    }
}
