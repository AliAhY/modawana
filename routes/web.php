<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['IsAdmin'],
], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index.admin'); // لوحة التحكم  
    Route::get('/update-password', [AdminController::class, 'showUpdatePassword'])->name('show-update-password');
    Route::post('/update-password', [AdminController::class, 'updatePassword'])->name('update-password');

    Route::resource('/books', BooksController::class);
    Route::post('/upload/blogs', [UploadController::class, 'upload_image_book'])->name('upload.books');
});

// مجموعة المسارات المحمية بـ 'auth'  
Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index.user');
    Route::get('/all_profiles', [UserController::class, 'allProfile'])->name('index.profiles');

    Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('user.profile');
    // Route::get('/profile/{id}/{post_id?}', [ProfileController::class, 'profile'])->name('user.profile');  
    Route::get('/edit_profile_form/{id}', [ProfileController::class, 'edit_profile_form'])->name('user.edit_profile_form');
    Route::post('/upload/profile/{id}', [ProfileController::class, 'upload_profile_photo'])->name('upload.profile');
    Route::post('/upload/profile_cover/{id}', [ProfileController::class, 'upload_profile_cover'])->name('upload.cover');
    Route::put('/update_profile/{id}', [ProfileController::class, 'update_profile'])->name('update.profile');

    Route::post('/send-friend-request/{recipientId}', [ProfileController::class, 'sendFriendRequest'])->name('friend.request.send');
    Route::post('/cancel-friend-request/{recipientId}', [ProfileController::class, 'cancelFriendRequest'])->name('friend.request.cancel');
    Route::post('/accept-friend-request/{requestId}', [ProfileController::class, 'acceptFriendRequest'])->name('friend.request.accept');
    Route::post('/friend/remove/{id}', [ProfileController::class, 'removeFriend'])->name('friend.request.remove');
    Route::post('/friend-request/reject/{requestId}', [ProfileController::class, 'rejectFriendRequest'])->name('friend.request.reject');
    Route::get('/profile/friends/friends_requests/{id}', [ProfileController::class, 'showFriendRequests'])->name('profile.friendes');
    Route::get('/profile/friends/all_friends/{id}', [ProfileController::class, 'showFriends'])->name('profile.allfriendes');
    Route::get('/profile/friends/all_add_friendes/{id}', [ProfileController::class, 'AllAddsFriends'])->name('profile.AllAddsFriends');

    Route::get('/profile/{name}/{id}', [ProfileController::class, 'show_other'])->name('profile.other');
    Route::get('/profile/all_friends_of/{name}/{id}', [ProfileController::class, 'friends_of_other'])->name('profile.other.friends');

    Route::post('/posts/{id}', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/site/profile/edit_post/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/profile/edit_posts/{id}', [PostController::class, 'update'])->name('posts.update');


    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

    Route::delete('comments/{id}', [PostController::class, 'destroyComment'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'store']);
    Route::delete('/comments/{comment}/like', [CommentLikeController::class, 'destroy']);

    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');

    Route::post('/posts/reports/{id}', [ReportController::class, 'store'])->name('reports.store');

});
