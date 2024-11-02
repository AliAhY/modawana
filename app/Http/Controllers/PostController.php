<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function store(Request $request, string $id)
    {
        $request->validate([
            'content' => 'nullable|required_without:image', // إذا لم يتم تقديم الصورة، تكون المحتوى مطلوبًا  
            'image' => 'nullable|file|mimetypes:video/mp4,image/jpeg,image/png|max:1024000|required_without:content', // إذا لم يتم تقديم المحتوى، تكون الصورة مطلوبة  
            'profile_id' => 'nullable|integer',
        ]);

        $post = new Post();
        if ($request->content) {
            $post->content = $request->input('content');
        } else {
            $post->content = '';
        }
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


    public function edit($id)
    {
        // return $id;
        $post = Post::find($id); // البحث عن البوست باستخدام المعرف
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'البوست غير موجود');
        }
        return view('site.profile.edit_posts', compact('post')); // تمرير البوست إلى العرض
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id); // البحث عن البوست باستخدام المعرف
        // return $post;
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'البوست غير موجود');
        }

        $request->validate([
            'content' => 'nullable|required_without:image', // إذا لم يتم تقديم الصورة، تكون المحتوى مطلوبًا  
            'image' => 'nullable|file|mimetypes:video/mp4,image/jpeg,image/png|max:1024000|required_without:content', // إذا لم يتم تقديم المحتوى، تكون الصورة مطلوبة  
            'profile_id' => 'nullable|integer',
        ]);

        if ($request->content) {
            $post->content = $request->input('content'); // تحديث المحتوى
        } else {
            $post->content = ''; // تحديث المحتوى
        }

        // إنشاء مسار التخزين  
        $userDirectory = "media/users/User_ID_$post->profile_id/posts/Post_$post->id/"; //تعيين المسار   

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
        $post->save(); // حفظ التغييرات
        return back()->with('success', 'تم تحديث البوست بنجاح');
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

    public function destroyComment($id)
    {
        // العثور على التعليق باستخدام المعرف  
        $comment = Comment::findOrFail($id);

        // حذف جميع الإعجابات المرتبطة بالتعليق  
        $comment->likes()->delete();

        // حذف التعليق  
        $comment->delete();

        // إرجاع استجابة ناجحة  
        return response()->json(['success' => 'تم حذف التعليق بنجاح.']);
    }

    public function profile_react($id)
    {
        // التحقق مما إذا كان هناك post_id  
        if ($id) {
            $post = Post::with('likes.profile')->where('id', $id)->first();

            // إذا كان المنشور موجودًا، احصل على الأشخاص الذين قاموا بعمل "لايك"  
            if ($post) {
                $likes = $post->likes()->with('profile')->get();
                // إعادة استجابة JSON مع بيانات الإعجابات  
                return response()->json($likes);
            }
        }

        // إذا لم يوجد أي منشور، إعادة استجابة فارغة أو برسالة خطأ  
        return response()->json([]);
    }
}
