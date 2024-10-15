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
        'image' => 'nullable|file|mimetypes:video/mp4,image/jpeg,image/png|max:1024000', // allow MP4 videos and JPEG/PNG images, max size 1GB
        'profile_id' => 'nullable|integer',
    ]);

    $post = new Post();
    $post->content = $request->input('content');

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        if ($file->getClientMimeType() == 'video/mp4') {
            $file->move(public_path('videos'), $fileName);
            $post->video = $fileName;
        } else {
            $file->move(public_path('images'), $fileName);
            $post->image = $fileName;
        }
    }

    $post->profile_id = $id;
    $post->save();

    return view('site.profile.index')->with('success', 'Post created successfully!');
}

public function destroy(Request $request, $id)
{
    $post = Post::find($id);
    if ($post) {
          // حذف التعليقات المرتبطة
          $post->comments()->delete();
        
          // حذف البوست
          $post->delete();
        return redirect()->back()->with('success', 'تم حذف البوست بنجاح!');
    } else {
        return redirect()->back()->with('error', 'لم يتم العثور على البوست!');
    }
}

}