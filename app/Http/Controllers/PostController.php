<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    // للقيام بإعجاب على المنشور  
    // public function like(Post $post)
    // {
    //     $profileId = Auth::user()->profile->id;

    //     // تحقق مما إذا كان المستخدم قد أعجب بالمنشور بالفعل  
    //     $like = Like::where('profile_id', $profileId)->where('post_id', $post->id)->first();

    //     if ($like) {
    //         // إذا كان قد أعجب به، نلغي الإعجاب  
    //         $like->delete();
    //         return back()->with('message', 'تم إلغاء الإعجاب!');
    //     } else {
    //         // إذا لم يكن قد أعجب به، نقوم بإعجابه  
    //         Like::create([
    //             'profile_id' => $profileId,
    //             'post_id' => $post->id,
    //         ]);
    //         return back()->with('message', 'تم الإعجاب!');
    //     }
    // }


    public function toggleLike($postId)
    {
        $post = Post::findOrFail($postId);
        $like = $post->likes()->where('profile_id', Auth::user()->profile->id)->first();

        if ($like) {
            $like->delete(); // إذا كان المستخدم يحب المنشور، قم بإلغاء الإعجاب  
            return response()->json(['success' => true]);
        } else {
            $post->likes()->create(['profile_id' => Auth::user()->profile->id]); // إذا لم يكن لديه إعجاب، قم بإعجابه  
            return response()->json(['success' => true]);
        }
    }
}
