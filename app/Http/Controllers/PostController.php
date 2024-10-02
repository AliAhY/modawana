<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // In your PostController.php file

public function store(Request $request, string $id)
{
    $request->validate([
        'content' => 'required',
        'image' => 'nullable|file',
        'profile_id' => 'nullable|integer',
    ]);

    $post = new Post();
    $post->content = $request->input('content');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $post->image = $imageName;
    }

    $post->profile_id = $id;
    $post->save();

    return view('site.profile.index')->with('success', 'Post created successfully!');
}
}
