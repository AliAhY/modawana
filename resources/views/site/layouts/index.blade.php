@extends('site.layouts.layout')
@section('main')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .card {
            margin-bottom: 30px;
        }

        .overflow-hidden {
            overflow: hidden !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .mt-n5 {
            margin-top: -3rem !important;
        }

        .linear-gradient {
            background-image: linear-gradient(#50b2fc, #f44c66);
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .d-flex {
            display: flex !important;
        }

        .rounded-2 {
            border-radius: 7px !important;
        }

        .bg-light-info {
            --bs-bg-opacity: 1;
            background-color: rgba(235, 243, 254, 1) !important;
        }

        .card {
            margin-bottom: 30px;
        }

        .position-relative {
            position: relative !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        .overflow-hidden {
            overflow: hidden !important;
        }

        .border {
            border: 1px solid #ebf1f6 !important;
            margin-top: 1px;
        }

        .fs-6 {
            font-size: 1.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .d-block {
            display: block !important;
        }

        a {
            text-decoration: none;
        }



        .mb-9 {
            margin-bottom: 20px !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .fs-4 {
            font-size: 1rem !important;
        }

        .card,
        .bg-light {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .fs-2 {
            font-size: .75rem !important;
        }

        .rounded-4 {
            border-radius: 4px !important;
        }

        .ms-7 {
            margin-left: 30px !important;
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="tab-content" id="pills-tabContent">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-none border">
                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store', $user_name->profile->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 137px"
                                    name="content"></textarea>
                                <label for="floatingTextarea2" class="p-7">Share your thoughts</label>
                            </div>
                            <div class="d-flex align-items-center gap-2">
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
                                <button class="btn btn-primary ms-auto" type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($posts->isNotEmpty())
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-body border-bottom">
                                <div class="d-flex align-items-center gap-3">
                                    <!-- صورة المستخدم -->
                                    @if ($post->profile->avatar == null)
                                        <img src="{{ asset($post->profile->gender == 'male' ? 'images/avatar6.png' : 'images/avatar3.png') }}"
                                            alt class="rounded-circle" width="40" height="40">
                                    @else
                                        @php
                                            $avatarData = json_decode($post->profile->avatar);
                                            $filename = $avatarData->filename ?? null;
                                        @endphp
                                        <img src="{{ url('/storage/media/users/User_ID_' . $post->profile->user_id . '/images/profile/' . $filename) }}"
                                            alt="Post Image" class="rounded-circle" width="40" height="40">
                                    @endif
                                    @if ($post->profile->id == auth()->user()->id)
                                        <a
                                            href="{{ route('user.profile', $post->profile->id) }}">{{ $post->profile->name }}</a>
                                    @else
                                        <a
                                            href="{{ route('profile.other', [$post->profile->name, $post->profile->id]) }}">{{ $post->profile->name }}</a>
                                    @endif
                                    {{-- <h6 class="fw-semibold mb-0 fs-4">{{ $post->profile->name }}</h6> --}}
                                    <span class="fs-2"><span
                                            class="p-1 bg-light rounded-circle d-inline-block"></span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-dark my-3">{{ $post->content }}</p>
                                @if ($post->image)
                                    <img src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/images/' . basename($post->image)) }}"
                                        alt="Post Picture" class="img-fluid rounded-4 w-100 object-fit-cover"
                                        style="height: 360px;">
                                @elseif($post->video)
                                    <video controls class="img-fluid rounded-4 w-100 object-fit-cover"
                                        style="height: 600px;">
                                        <source
                                            src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/videos/' . basename($post->video)) }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif

                                <div class="d-flex align-items-center my-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button"
                                            class="btn like-btn {{ $post->likes()->where('profile_id', Auth::user()->profile->id)->exists()? 'btn-primary': 'btn-outline-primary' }}"
                                            onclick="toggleLike({{ $post->id }}, this)">
                                            <i class="fa fa-thumbs-up"
                                                style="font-size: 1.2em; color: {{ $post->likes()->where('profile_id', Auth::user()->profile->id)->exists()? 'white': 'blue' }};"></i>
                                        </button>
                                        <span class="text-dark fw-semibold">{{ $post->likes()->count() }}
                                            Likes</span>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-4">
                                        <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Comment">
                                            <i class="fa fa-comments"></i>
                                        </a>
                                        <span id="comment-count-{{ $post->id }}">{{ $post->comments->count() }}</span>
                                    </div>
                                    <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Share">
                                        <i class="fa fa-share"></i>
                                    </a>

                                </div>

                                <div class="d-flex align-items-center gap-3 p-3 w-100">
                                    <h6 class="fw-semibold mb-0 fs-4">{{ Auth::user()->name }} :</h6>
                                    <form action="{{ route('comments.store') }}" method="post" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Comment"
                                                name="comment" required>
                                            <button class="btn btn-primary" type="submit">Comment</button>
                                        </div>
                                    </form>
                                </div>

                                <h2 class="text-center mb-4">التعليقات</h2>

                                <div class="text-center mb-3">
                                    <a href="javascript:void(0)" class="text-primary fw-semibold"
                                        onclick="toggleComments('{{ $post->id }}')">
                                        اقرأ المزيد من التعليقات
                                    </a>
                                </div>

                                <!-- التعليقات المخفية -->
                                <div id="comments-{{ $post->id }}" class="d-none mt-3">

                                    @foreach ($post->comments as $comment)
                                        <div class="card mb-3" id="comment-{{ $comment->id }}">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    @if ($comment->profile->avatar == null)
                                                        <img src="{{ asset($comment->profile->gender == 'male' ? 'images/avatar6.png' : 'images/avatar3.png') }}"
                                                            alt="avatar" class="rounded-circle" width="50"
                                                            height="50">
                                                    @else
                                                        @php
                                                            $avatarData = json_decode($comment->profile->avatar);
                                                            $filename = $avatarData->filename ?? null;
                                                        @endphp
                                                        <img src="{{ url('/storage/media/users/User_ID_' . $comment->profile->user_id . '/images/profile/' . $filename) }}"
                                                            alt="avatar" class="rounded-circle" width="50"
                                                            height="50">
                                                    @endif
                                                    <div class="ms-3">
                                                        <h6 class="fw-bold">{{ $comment->profile->name }}</h6>
                                                        <small
                                                            class="text-muted">{{ $comment->created_at->format('M d, Y \| h:i A') }}</small>
                                                    </div>
                                                </div>
                                                <span class="card-text"
                                                    id="comment-text-{{ $comment->id }}">{{ $comment->comment }}</span>
                                                @if ($comment->profile->id === auth()->user()->id)
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa fa-trash"
                                                            onclick="confirmDelete('{{ $comment->id }}')"
                                                            style="cursor: pointer; font-size: 24px; color: red; margin-right: 10px;">
                                                        </i>
                                                        {{-- زر اللايك على التعليق --}}
                                                        @php
                                                            $userLiked = $comment
                                                                ->likes()
                                                                ->where('profile_id', auth()->user()->profile->id)
                                                                ->exists();
                                                        @endphp
                                                        <i class="far fa-thumbs-up like-icon {{ $userLiked ? 'liked' : '' }}"
                                                            data-comment-id="{{ $comment->id }}"
                                                            data-profile-id="{{ auth()->user()->profile->id }}"
                                                            data-is-liked="{{ $userLiked }}"
                                                            onclick="toggleLikeComment(this)"
                                                            style="cursor: pointer; font-size: 24px; color: {{ $userLiked ? 'blue' : 'black' }};">
                                                        </i>
                                                        <span class="like-count"
                                                            id="like-count-{{ $comment->id }}">{{ $comment->likes()->count() }}</span>



                                                        <i class="fas fa-pen"
                                                            onclick="showEditForm({{ $comment->id }}, '{{ $comment->comment }}')"
                                                            style="cursor: pointer; font-size: 20px; margin-left: 10px; color: green;"
                                                            title="تعديل التعليق">
                                                        </i>
                                                        <!-- نموذج تعديل التعليق -->
                                                        <!-- نموذج تعديل التعليق -->
                                                        <div id="edit-form-{{ $comment->id }}" style="display: none;">
                                                            <input type="text" id="edit-input-{{ $comment->id }}"
                                                                value="{{ $comment->comment }}">

                                                            <!-- أيقونة الحفظ -->
                                                            <i class="fas fa-check"
                                                                onclick="updateComment({{ $comment->id }})"
                                                                style="cursor: pointer; font-size: 20px; color: green; margin-right: 10px;"
                                                                title="حفظ">
                                                            </i>

                                                            <!-- أيقونة الإلغاء -->
                                                            <i class="fas fa-times"
                                                                onclick="hideEditForm({{ $comment->id }})"
                                                                style="cursor: pointer; font-size: 20px; color: red;"
                                                                title="إلغاء">
                                                            </i>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center">
                                                        {{-- زر اللايك على التعليق --}}
                                                        @php
                                                            $userLiked = $comment
                                                                ->likes()
                                                                ->where('profile_id', auth()->user()->profile->id)
                                                                ->exists();
                                                        @endphp
                                                        <i class="far fa-thumbs-up like-icon {{ $userLiked ? 'liked' : '' }}"
                                                            data-comment-id="{{ $comment->id }}"
                                                            data-profile-id="{{ auth()->user()->profile->id }}"
                                                            data-is-liked="{{ $userLiked }}"
                                                            onclick="toggleLikeComment(this)"
                                                            style="cursor: pointer; font-size: 24px; color: {{ $userLiked ? 'blue' : 'black' }}">
                                                        </i>
                                                        <span class="like-count"
                                                            id="like-count-{{ $comment->id }}">{{ $comment->likes()->count() }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No posts found.</p>
                @endif

                <!-- JavaScript للتبديل بين عرض التعليقات المخفية والمرئية -->
                <script>
                    function toggleComments(postId) {
                        const commentsSection = document.getElementById('comments-' + postId);
                        commentsSection.classList.toggle('d-none'); // Toggle الclass المخفي  
                    }
                </script>

            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <script>
        function toggleComments(postId) {
            var commentsDiv = document.getElementById('comments-' + postId);
            if (commentsDiv.classList.contains('d-none')) {
                commentsDiv.classList.remove('d-none');
            } else {
                commentsDiv.classList.add('d-none');
            }
        }


        function toggleLike(postId, button) {
            // إرسال طلب AJAX إلى الخادم  
            fetch(`/posts/${postId}/toggle-like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', //  CSRF Token  
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // تشغيل صوت الإشعار  
                        const audio = new Audio('/sounds/like_effect.m4a');
                        audio.play();

                        // تحديث الواجهة بناءً على حالة الإعجاب  
                        const currentLikes = parseInt(button.nextElementSibling.innerText);
                        button.classList.toggle('btn-primary');
                        button.classList.toggle('btn-outline-primary');

                        // تغيير لون الأيقونة  
                        button.querySelector('i').style.color = button.classList.contains('btn-primary') ? 'white' :
                            'blue';

                        // تحديث العدد  
                        if (button.classList.contains('btn-primary')) {
                            button.nextElementSibling.innerText = currentLikes + 1; // إضافة إعجاب  
                        } else {
                            button.nextElementSibling.innerText = currentLikes - 1; // إزالة إعجاب  
                        }
                    } else {
                        console.error('Failed to toggle like:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }


        function confirmDelete(commentId, postId) {
            // الكود لإجراء تأكيد الحذف  
            fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => {
                    if (!response.ok) throw new Error('فشل حذف التعليق.');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('comment-' + commentId).remove(); // حذف تعليق من الصفحة  
                    // تحديث العداد  
                    const commentCountElement = document.getElementById('comment-count-' + postId);
                    if (commentCountElement) {
                        let currentCount = parseInt(commentCountElement.textContent) || 0;
                        commentCountElement.textContent = Math.max(0, currentCount - 1);
                    }
                })
                .catch(error => console.error('حدث خطأ:', error));
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.like-button').click(function() {
                const commentId = $(this).data('comment-id');
                const likeCountElement = $('#like-count-' + commentId);
                const currentCount = parseInt(likeCountElement.text(), 10);

                $.ajax({
                    url: '/comments/' + commentId + '/like', //   إعداد المسار الصحيح  
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' //   تضمين توكن CSRF  
                    },
                    success: function(response) {
                        likeCountElement.text(response.new_like_count); // تحديث عدد اللايكات  
                    },
                    error: function(xhr) {
                        if (xhr.status === 400) {
                            alert(xhr.responseJSON.error); // إخطار المستخدم إذا كان هناك خطأ  
                        } else {
                            console.error(xhr); // طباعة الأخطاء في وحدة التحكم  
                        }
                    }
                });
            });
        });


        // وضع لايك على التعليق
        function toggleLikeComment(button) {
            const commentId = button.getAttribute('data-comment-id');
            const profileId = button.getAttribute('data-profile-id');
            const likeCountSpan = document.getElementById(`like-count-${commentId}`);

            const isLiked = button.classList.toggle('liked');
            const method = isLiked ? 'POST' : 'DELETE';

            fetch(`/comments/${commentId}/like`, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        profile_id: profileId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Something went wrong');
                })
                .then(data => {
                    if (isLiked) {
                        // زيادة عدد الإعجابات فقط إذا كان الإعجاب الجديد صحيحًا  
                        if (data.success) {
                            likeCountSpan.textContent = parseInt(likeCountSpan.textContent, 10) + 1;
                        }
                        button.style.color = 'blue'; // تغيير لون الأيقونة إلى الأزرق  
                    } else {
                        // تقليل عدد الإعجابات إذا كان الإعجاب تمت إزالته  
                        if (data.success) {
                            likeCountSpan.textContent = parseInt(likeCountSpan.textContent, 10) - 1;
                        }
                        button.style.color = ''; // إعادة لون الأيقونة إلى الافتراضي  
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>


    {{-- تعديل التعليق باستخدام js --}}
    <script>
        function showEditForm(commentId, commentText) {
            document.getElementById('edit-form-' + commentId).style.display = 'block';
            document.getElementById('edit-input-' + commentId).value =
                commentText; // وضع نص التعليق الأصلي في حقل الإدخال  
        }

        // اخفاء الفورم
        function hideEditForm(commentId) {
            document.getElementById('edit-form-' + commentId).style.display = 'none';
        }

        function updateComment(commentId) {
            const newCommentText = document.getElementById('edit-input-' + commentId).value;

            // تنفيذ طلب AJAX لتحديث التعليق  
            fetch(`/comments/${commentId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // إذا كنت تستخدم Laravel  
                    },
                    body: JSON.stringify({
                        comment: newCommentText
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    // تحديث التعليق في الصفحة  
                    document.getElementById('comment-text-' + commentId).innerText = newCommentText;
                    hideEditForm(commentId);
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
    </script>
@endsection
