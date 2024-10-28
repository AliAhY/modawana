@extends('site.layouts.layout')

@section('main')

    <body>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <h2>تعديل البوست</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($post)
                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- قسم إضافة بوست -->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 137px"
                            name="content">{{ $post->content }}</textarea>
                        <label for="floatingTextarea2" class="p-7">Share your thoughts</label>
                    </div>



                    <!-- قسم الصور والفيديوهات -->
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                            href="javascript:void(0)" onclick="document.getElementById('image').click()">
                            <i class="fa fa-photo"></i>
                            <input type="file" name="image" id="image" class="d-none">
                        </a>
                        <a href="javascript:void(0)" class="text-dark px-3 py-2">Photo / Video</a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2">
                            <div
                                class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle">
                                <i class="fa fa-list"></i>
                            </div>
                            <span class="text-dark">Article</span>
                        </a>
                    </div>

                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            @if ($post->image)
                                <img src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/images/' . basename($post->image)) }}"
                                    alt="Post Picture" class="img-fluid rounded-4 w-100 object-fit-cover"
                                    style="height: 360px;">
                            @elseif($post->video)
                                <video controls preload="auto" class="img-fluid rounded-4 w-100 object-fit-cover"
                                    style="height: 360px;">
                                    <source
                                        src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/videos/' . basename($post->video)) }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    </div>
                    <div style="text-align: center">
                        <button type="submit" class="btn btn-primary mb-4">تحديث البوست</button>
                    </div>
                </form>
            @else
                <p>البوست غير موجود</p>
            @endif
        </div>
    @endsection
