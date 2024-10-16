<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   
    public function store(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|file|mimetypes:video/mp4,image/jpeg,image/png|max:1024000', // allow MP4 videos and JPEG/PNG images, max size 1GB  
            'profile_id' => 'nullable|integer',
        ]);

        $post = new Post();
        $post->content = $request->input('content');
        $post->profile_id = $id; // تعيين معرف البروفايل  

        // حفظ البوست أولاً للحصول على معرفه  
        $post->save(); // يجب حفظ البوست أولاً للحصول على معرفه  

        // الحصول على معرف البوست  
        $postId = $post->id;

        // إنشاء مسار التخزين  
        $userDirectory = "media/users/User_ID_$id/posts/Post_$postId/"; //تعيين المسار   

        // معالجة الملف  
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // استخدام التخزين  
            if ($file->getClientMimeType() == 'video/mp4') {
                $file->storeAs($userDirectory . 'videos/', $fileName, 'public'); // تخزين الفيديو  
                $post->video = "videos/$fileName"; // حفظ المسار   
            } else {
                $file->storeAs($userDirectory . 'images/', $fileName, 'public'); // تخزين الصورة  
                $post->image = "images/$fileName"; // حفظ المسار   
            }
        }

        $post->save();

        return back()->with('success', 'Post created successfully!');
    }
    public function show($id)
    {
        // $user_name = User::findOrFail($id);
        $posts = Post::with('comments.profile')->where('user_id', $id)->get() ?? collect();
        return $posts;
        // $posts = Profile::where('user_id', $id)->with('post')->first();

        return view('site.profile.index', compact('posts'));
    }
}
