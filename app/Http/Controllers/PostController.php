<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // In your PostController.php file

    // public function store(Request $request, string $id)
    // {
    //     $request->validate([
    //         'content' => 'required',
    //         'image' => 'nullable|file|mimetypes:video/mp4,image/jpeg,image/png|max:1024000', // allow MP4 videos and JPEG/PNG images, max size 1GB
    //         'profile_id' => 'nullable|integer',
    //     ]);

    //     $post = new Post();
    //     $post->content = $request->input('content');

    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $fileName = time() . '.' . $file->getClientOriginalExtension();
    //         if ($file->getClientMimeType() == 'video/mp4') {
    //             $file->move(public_path('videos'), $fileName);
    //             $post->video = $fileName;
    //         } else {
    //             $file->move(public_path('images'), $fileName);
    //             $post->image = $fileName;
    //         }
    //     }

    //     $post->profile_id = $id;
    //     $post->save();

    //     return back()->with('success', 'Post created successfully!');
    // }


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
        $post->save();

        // الحصول على معرف البوست  
        $postId = $post->id;

        // إنشاء مسار التخزين  
        $userDirectory = public_path("media/users/User_ID_$id/posts/$postId/");

        // التأكد من وجود المجلد  
        if (!file_exists($userDirectory)) {
            mkdir($userDirectory, 0755, true); // إنشاء المجلد إذا لم يكن موجودًا  
        }

        // معالجة الملف  
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            if ($file->getClientMimeType() == 'video/mp4') {
                $file->move($userDirectory . 'videos/', $fileName); // تخزين الفيديو  
                $post->video = "videos/$fileName"; // حفظ المسار النسبي  
            } else {
                $file->move($userDirectory . 'images/', $fileName); // تخزين الصورة  
                $post->image = "images/$fileName"; // حفظ المسار النسبي  
            }
        }

        // تحديث البوست مع معلومات الملف  
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
