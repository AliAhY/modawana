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
            margin-right: 0px;
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

        .user-profile-tab .nav-item .nav-link.active {
            color: #5d87ff;
            border-bottom: 2px solid #5d87ff;
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

        .cover-image {
            width: 100%;
            /* يضمن أن الصورة تأخذ العرض الكامل للكارد */
            height: 400px;
            /* ارتفاع ثابت */
            object-fit: cover;
            /* الصورة ستغطي العنصر بالكامل */
        }
    </style>
    </head>

    <body>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        {{-- <div class="container"> --}}
        <div class="card overflow-hidden">
            <div class="card-body p-0">

                @if ($user_name->profile->cover_image == null)
                    <img src="https://www.bootdey.com/image/1352x300/FF7F50/000000" alt class="img-fluid cover-image">
                @else
                    @php
                        // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                        $cover_imageData = json_decode($user_name->profile->cover_image);
                        $filename = $cover_imageData->filename ?? null; // التأكد من وجود البيانات
                    @endphp

                    @if ($filename)
                        <img src="{{ url('/storage/media/users/User_ID_' . $user_name->profile->user_id . '/images/cover/' . $filename) }}"
                            alt="Cover Photo" class="img-fluid cover-image">
                    @else
                        <img src="https://www.bootdey.com/image/1352x300/FF7F50/000000" alt class="img-fluid cover-image">
                    @endif
                @endif
                <div class="row align-items-center">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="d-flex align-items-center justify-content-around m-4">
                            <div class="text-center">
                                <i class="fa fa-file fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">{{ $num_posts }}</h4>
                                <p class="mb-0 fs-4">Posts</p>
                            </div>
                            <div class="text-center">
                                <i class="fa fa-user fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">3,586</h4>
                                <p class="mb-0 fs-4">Followers</p>
                            </div>
                            <div class="text-center">
                                <i class="fa fa-check fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">2,659</h4>
                                <p class="mb-0 fs-4">Following</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                        <div class="mt-n5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 110px; height: 110px;" ;>
                                    <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                                        style="width: 100px; height: 100px;" ;>

                                        @if ($user_name->profile->avatar == null)
                                            @if ($user_name->gender == 'male')
                                                <img src="{{ asset('images/avatar6.png') }}" alt class="w-100 h-100">
                                            @else
                                                <img src="{{ asset('images/avatar3.png') }}" alt class="w-100 h-100">
                                            @endif
                                        @else
                                            @php
                                                // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                                                $avatarData = json_decode($user_name->profile->avatar);
                                                $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                                            @endphp

                                            {{-- @if ($filename) --}}
                                            <img src="{{ url('/storage/media/users/User_ID_' . $user_name->profile->user_id . '/images/profile/' . $filename) }}"
                                                alt="Avatar Photo" class="w-100 h-100">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="fs-5 mb-0 fw-semibold">{{ $user_name->profile->name }}</h5>
                                <p class="mb-0 fs-4">{{ $user_name->profile->bio }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-last">
                        <ul
                            class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start my-3 gap-3">
                            <li class="position-relative">
                                <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                    href="javascript:void(0)" width="30" height="30">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white bg-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle "
                                    href="javascript:void(0)">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white bg-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle "
                                    href="javascript:void(0)">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white bg-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle "
                                    href="javascript:void(0)">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            <li><a href="{{ route('user.edit_profile_form', $user_name->profile->id) }}"><button
                                        class="btn btn-primary">Edit Profile</button></a></li>

                        </ul>
                    </div>
                </div>
                <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('user.profile', $user_name->profile->id) }}">
                            <button
                                class="nav-link position-relative rounded-0 {{ $activeTab === 'Profile' ? 'active' : '' }} d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-friends-tab">
                                <i class="fas fa-user-friends me-2 fs-6"></i>
                                <span class="d-none d-md-block">Profile</span>
                            </button>

                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-followers-tab">
                            <i class="fa fa-heart me-2 fs-6"></i>
                            <span class="d-none d-md-block">Followers</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('profile.friendes', $user_name->profile->id) }}">
                            <button
                                class="nav-link position-relative rounded-0 {{ $activeTab === 'Friends Request' ? 'active' : '' }} d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-friends-tab">
                                <i class="fas fa-users me-2 fs-6"></i> <!-- أيقونة جديدة لطلبات الأصدقاء المستقبلة -->
                                <span class="d-none d-md-block">Friends Request</span>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('profile.AllAddsFriends', $user_name->profile->id) }}">
                            <button
                                class="nav-link position-relative rounded-0 {{ $activeTab === 'Add Friends' ? 'active' : '' }} d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-friends-tab">
                                <i class="fas fa-paper-plane me-2 fs-6"></i>
                                <!-- أيقونة جديدة لطلبات الصداقة المرسلة -->
                                <span class="d-none d-md-block">Add Friends</span>
                            </button>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('profile.allfriendes', $user_name->profile->id) }}">
                            <button
                                class="nav-link position-relative rounded-0 {{ $activeTab === 'Friends' ? 'active' : '' }} d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-friends-tab">
                                <i class="fas fa-user-friends me-2 fs-6"></i>
                                <span class="d-none d-md-block">Friends<span
                                        style="color: green">{{ $num_of_frind }}</span></span>
                            </button>

                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-gallery-tab">
                            <i class="fa fa-photo me-2 fs-6"></i>
                            <span class="d-none d-md-block">Gallery</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">Introduction</h4>
                                <p>Hello, I am Mathew Anderson. I love making websites and graphics. Lorem ipsum dolor
                                    sit amet, consectetur adipiscing elit.</p>
                                <ul class="list-unstyled mb-0">
                                    @if (!empty($user_name->profile->professional_title))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-briefcase text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">
                                                {{ $user_name->profile->professional_title }}
                                            </h6>
                                        </li>
                                    @endif
                                    @if (!empty($user_name->profile->email))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-envelope text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0"><a href="/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="39414043535657584d515857795e54585055175a5654">{{ $user_name->profile->email }}</a>
                                            </h6>
                                        </li>
                                    @endif
                                    @if (!empty($user_name->profile->universe_name))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-graduation-cap text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $user_name->profile->universe_name }}
                                            </h6>
                                        </li>
                                    @endif
                                    @if (!empty($user_name->profile->school_name))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-graduation-cap text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $user_name->profile->school_name }}
                                            </h6>
                                        </li>
                                    @endif
                                    @if (!empty($user_name->profile->location))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-home text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $user_name->profile->location }}</h6>
                                        </li>
                                    @endif
                                    @if (!empty($user_name->profile->date_of_birth))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-birthday-cake text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $user_name->profile->date_of_birth }}
                                            </h6>
                                        </li>
                                    @endif
                                    @if (!empty($user_name->profile->gender))
                                        <!-- عرض عنصر li إذا كانت البيانات غير فارغة -->
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-user text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">{{ $user_name->profile->gender }}</h6>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">Photos</h4>
                                <div class="row">
                                    @foreach ($img_posts as $img_post)
                                        <div class="col-4">
                                            <img src="{{ url('storage/media/users/User_ID_' . $img_post->profile_id . '/posts/Post_' . $img_post->id . '/images/' . basename($img_post->image)) }}"
                                                alt class="rounded-2 img-fluid mb-9">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8">

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
                                            @if ($user_name->profile->avatar == null)
                                                <img src="{{ asset($user_name->gender == 'male' ? 'images/avatar6.png' : 'images/avatar3.png') }}"
                                                    alt class="rounded-circle" width="40" height="40">
                                            @else
                                                @php
                                                    $avatarData = json_decode($user_name->profile->avatar);
                                                    $filename = $avatarData->filename ?? null;
                                                @endphp
                                                <img src="{{ url('/storage/media/users/User_ID_' . $user_name->profile->user_id . '/images/profile/' . $filename) }}"
                                                    alt="Post Image" class="rounded-circle" width="40"
                                                    height="40">
                                            @endif

                                            <h6 class="fw-semibold mb-0 fs-4">{{ $user_name->profile->name }}</h6>
                                            <span class="fs-2"><span
                                                    class="p-1 bg-light rounded-circle d-inline-block"></span>{{ $post->created_at }}</span>

                                            <!-- زر التعديل -->
                                            <div class="ms-auto">
                                                <form action="{{ route('posts.edit', $post->id) }}" method="get">
                                                    @csrf
                                                    <button class="btn btn-warning" type="submit">تعديل</button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="text-dark my-3">{{ $post->content }}</p>
                                        @if ($post->image)
                                            <img src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/images/' . basename($post->image)) }}"
                                                alt="Post Picture" class="img-fluid rounded-4 w-100 object-fit-cover"
                                                style="height: 360px;">
                                        @elseif($post->video)
                                            <video controls preload="auto"
                                                class="img-fluid rounded-4 w-100 object-fit-cover" style="height: 360px;">
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

                                                <a href="javascript:void(0);" class="like-link"
                                                    data-id="{{ $post->id }}">
                                                    <span class="text-dark fw-semibold">{{ $post->likes()->count() }}
                                                        Likes</span>
                                                </a>
                                                <div class="modal fade" id="likesModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="likesModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="likesModalLabel">الإعجابات
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- سيتم ملء محتوى هذه المنطقة من خلال JavaScript -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">إغلاق</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-2 ms-4">
                                                <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Comment">
                                                    <i class="fa fa-comments"></i>
                                                </a>
                                                <span id="comment-count"
                                                    class="text-dark fw-semibold">{{ $post->comments->count() }}</span>

                                            </div>
                                            <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Share">
                                                <i class="fa fa-share"></i>
                                            </a>

                                            <!-- Add delete button -->
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">حذف</button>
                                            </form>
                                        </div>
                                        <div class="d-flex align-items-center gap-3 p-3 w-100">
                                            {{-- @dd($user_name->profile->avatar) --}}
                                            @if ($user_name->profile->avatar == null)
                                                @if ($user_name->gender == 'male')
                                                    <img src="{{ asset('images/avatar6.png') }}" alt
                                                        class="rounded-circle" width="40" height="40">
                                                @else
                                                    <img src="{{ asset('images/avatar3.png') }}" alt
                                                        class="rounded-circle" width="40" height="40">
                                                @endif
                                            @else
                                                @php
                                                    $avatarData = json_decode($user_name->profile->avatar);
                                                    $filename = $avatarData->filename ?? null;
                                                @endphp
                                                <img src="{{ url('/storage/media/users/User_ID_' . $user_name->profile->user_id . '/images/profile/' . $filename) }}"
                                                    alt="Post Image" class="rounded-circle" width="40"
                                                    height="40">
                                            @endif
                                            <h6 class="fw-semibold mb-0 fs-4">{{ $user_name->name }} :</h6>
                                            <form action="{{ route('comments.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <div class="input-group w-100">
                                                    <input type="text" class="form-control flex-grow-1"
                                                        id="exampleInputtext" aria-describedby="textHelp"
                                                        placeholder="Comment" name="comment" required>
                                                    <div class="input-group-append ms-auto">
                                                        <button class="btn btn-primary" type="submit">Comment</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="container my-5">
                                            <h2 class="text-center mb-4">التعليقات</h2>

                                            <div class="text-center mb-3">
                                                <a href="javascript:void(0)" class="text-primary fw-semibold"
                                                    onclick="toggleComments('{{ $post->id }}')">
                                                    اقرأ المزيد من التعليقات
                                                </a>
                                            </div>

                                            <div id="comments-{{ $post->id }}" class="d-none mt-3">

                                                @foreach ($post->comments as $comment)
                                                    <div class="card mb-3" id="comment-{{ $comment->id }}">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                @if ($comment->profile->avatar == null)
                                                                    <img src="{{ asset($comment->profile->gender == 'male' ? 'images/avatar6.png' : 'images/avatar3.png') }}"
                                                                        alt="avatar" class="rounded-circle"
                                                                        width="50" height="50">
                                                                @else
                                                                    @php
                                                                        $avatarData = json_decode(
                                                                            $comment->profile->avatar,
                                                                        );
                                                                        $filename = $avatarData->filename ?? null;
                                                                    @endphp
                                                                    <img src="{{ url('/storage/media/users/User_ID_' . $comment->profile->user_id . '/images/profile/' . $filename) }}"
                                                                        alt="avatar" class="rounded-circle"
                                                                        width="50" height="50">
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
                                                                            ->where(
                                                                                'profile_id',
                                                                                auth()->user()->profile->id,
                                                                            )
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
                                                                    <div id="edit-form-{{ $comment->id }}"
                                                                        style="display: none;">
                                                                        <input type="text"
                                                                            id="edit-input-{{ $comment->id }}"
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
                                                                            ->where(
                                                                                'profile_id',
                                                                                auth()->user()->profile->id,
                                                                            )
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
                                </div>
                            @endforeach
                        @else
                            <p>No posts found.</p>
                        @endif
                    </div>
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
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // تأكد من إضافة CSRF Token  
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // تشغيل صوت الإشعار  
                            const audio = new Audio('/sounds/like_effect.m4a'); // تأكد من وضع المسار الصحيح للملف الصوتي  
                            audio.play();

                            // تحديث الواجهة بناءً على حالة الإعجاب  
                            const currentLikes = parseInt(button.nextElementSibling.innerText); // عدد الإعجابات الحالي  
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


            document.addEventListener('DOMContentLoaded', function() {
                window.confirmDelete = function(commentId) {
                    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfTokenElement.getAttribute('content');
                    if (confirm("هل أنت متأكد أنك تريد حذف هذا التعليق؟")) {
                        fetch(`/comments/${commentId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('حدث خطأ أثناء حذف التعليق.');
                                }
                            })
                            .then(data => {
                                const commentElement = document.getElementById('comment-' + commentId);
                                if (commentElement) {
                                    commentElement.remove(); // حذف التعليق من الصفحة  
                                    console.log("تم حذف التعليق بنجاح.");

                                    // تحديث عدد التعليقات  
                                    const commentCountElement = document.getElementById('comment-count');
                                    if (commentCountElement) {
                                        let currentCount = parseInt(commentCountElement.textContent);
                                        currentCount = isNaN(currentCount) ? 0 :
                                            currentCount; // تأكد أن العدد صحيح  
                                        commentCountElement.textContent = currentCount - 1; // تقليل العدد  
                                    }
                                } else {
                                    console.warn('لم يتم العثور على التعليق في الـ DOM: comment-' + commentId);
                                }
                            })
                            .catch(error => {
                                alert(error.message);
                                console.error('هناك مشكلة:', error);
                            });
                    }
                };
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.like-button').click(function() {
                    const commentId = $(this).data('comment-id');
                    const likeCountElement = $('#like-count-' + commentId);
                    const currentCount = parseInt(likeCountElement.text(), 10);

                    $.ajax({
                        url: '/comments/' + commentId + '/like', //  إعداد المسار الصحيح  
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
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
