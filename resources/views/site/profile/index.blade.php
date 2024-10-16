@extends('site.layouts.layout')
@section('main')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="container">
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
                            <img src="https://www.bootdey.com/image/1352x300/FF7F50/000000" alt
                                class="img-fluid cover-image">
                        @endif
                    @endif
                    <div class="row align-items-center">
                        <div class="col-lg-4 order-lg-1 order-2">
                            <div class="d-flex align-items-center justify-content-around m-4">
                                <div class="text-center">
                                    <i class="fa fa-file fs-6 d-block mb-2"></i>
                                    <h4 class="mb-0 fw-semibold lh-1">938</h4>
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
                    <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2"
                        id="pills-tab" role="tablist">
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
                                    <span class="d-none d-md-block">Friends</span>
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
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                                class="rounded-2 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt
                                                class="rounded-2 img-fluid mb-9">
                                        </div>
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
                                                href="javascript:void(0)"
                                                onclick="document.getElementById('image').click()">
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
                                <!-- تحقق مما إذا كان هناك منشورات -->
                                @foreach ($posts as $post)
                                    {{-- @dd($user_name) --}}
                                    {{-- @dd($post->profile_id) --}}
                                    <!-- استخدم $posts بدلاً من $posts->post -->
                                    <div class="card">
                                        <div class="card-body border-bottom">
                                            <div class="d-flex align-items-center gap-3">
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

                                                <h6 class="fw-semibold mb-0 fs-4"> {{ $user_name->name }}
                                                </h6>
                                                <span class="fs-2"><span
                                                        class="p-1 bg-light rounded-circle d-inline-block"></span>
                                                    {{ $post->created_at }}</span>
                                            </div>
                                            <p class="text-dark my-3">
                                                {{ $post->content }}
                                            </p>
                                            @if ($post->image)
                                                <img src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/images/' . basename($post->image)) }}"
                                                    alt="Post Picture" class="img-fluid rounded-4 w-100 object-fit-cover"
                                                    style="height: 360px;">
                                            @elseif($post->video)
                                                <video controls class="img-fluid rounded-4 w-100 object-fit-cover"
                                                    style="height: 360px;">
                                                    <source
                                                        src="{{ url('storage/media/users/User_ID_' . $post->profile_id . '/posts/Post_' . $post->id . '/videos/' . basename($post->video)) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                            {{-- <video src=""></video> --}}
                                            <div class="d-flex align-items-center my-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Like">
                                                        <i class="fa fa-thumbs-up"></i>
                                                    </a>
                                                    <span class="text-dark fw-semibold">67</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 ms-4">
                                                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Comment">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                    <span
                                                        class="text-dark fw-semibold">{{ $post->comments->count() }}</span>
                                                </div>
                                                <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Share">
                                                    <i class="fa fa-share"></i>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 p-3 w-100">
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
                                                <form action="{{ route('comments.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <div class="input-group w-100">
                                                        <input type="text" class="form-control flex-grow-1"
                                                            id="exampleInputtext" aria-describedby="textHelp"
                                                            placeholder="Comment" name="comment" required>
                                                        <div class="input-group-append ms-auto">
                                                            <button class="btn btn-primary"
                                                                type="submit">Comment</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @foreach ($posts as $post)
                                                <div class="position-relative">
                                                    <!-- عرض التعليق الأول فقط -->
                                                    @if ($post->comments->isNotEmpty())
                                                        @php
                                                            $comment = $post->comments->first(); // الحصول على التعليق الأول فقط
                                                        @endphp
                                                        <div class="p-4 rounded-2 bg-light mb-3">
                                                            <div class="d-flex align-items-center gap-3 p-3">
                                                                @if ($comment->profile->avatar == null)
                                                                    @if ($comment->profile->gender == 'male')
                                                                        <img src="{{ asset('images/avatar6.png') }}" alt
                                                                            class="rounded-circle" width="33"
                                                                            height="33">
                                                                    @else
                                                                        <img src="{{ asset('images/avatar3.png') }}" alt
                                                                            class="rounded-circle" width="33"
                                                                            height="33">
                                                                    @endif
                                                                @else
                                                                    @php
                                                                        $avatarData = json_decode(
                                                                            $comment->profile->avatar,
                                                                        );
                                                                        $filename = $avatarData->filename ?? null;
                                                                    @endphp
                                                                    <img src="{{ url('/storage/media/users/User_ID_' . $comment->profile->user_id . '/images/profile/' . $filename) }}"
                                                                        alt class="rounded-circle" width="33"
                                                                        height="33">
                                                                @endif
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    {{ $comment->profile->name }}</h6>
                                                                <span class="fs-2"><span
                                                                        class="p-1 bg-muted rounded-circle d-inline-block"></span>
                                                                    {{ $comment->profile->created_at }}</span>
                                                            </div>

                                                            {{-- هنا تم تعديل لعرض تعليق واحد فقط --}}
                                                            <p class="my-3">{{ $comment->comment }}</p>

                                                            <div class="d-flex align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" data-bs-title="Like">
                                                                        <i class="fa fa-thumbs-up"></i>
                                                                    </a>
                                                                    <span class="text-dark fw-semibold">55</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                             
                                                    <div>
                                                        <a href="javascript:void(0)" class="text-primary"
                                                            onclick="toggleComments('{{ $post->id }}')">اقرأ المزيد من
                                                            التعليقات</a>
                                                    </div>

                                                    <!-- التعليقات المخفية -->
                                                    <div id="comments-{{ $post->id }}" class="d-none mt-3">
                                                        @foreach ($post->comments as $comment)
                                                            <div class="p-4 rounded-2 bg-light mb-3">
                                                                <div class="d-flex align-items-center gap-3 p-3">
                                                                    @if ($comment->profile->avatar == null)
                                                                        @if ($comment->profile->gender == 'male')
                                                                            <img src="{{ asset('images/avatar6.png') }}"
                                                                                alt class="rounded-circle" width="33"
                                                                                height="33">
                                                                        @else
                                                                            <img src="{{ asset('images/avatar3.png') }}"
                                                                                alt class="rounded-circle" width="33"
                                                                                height="33">
                                                                        @endif
                                                                    @else
                                                                        @php
                                                                            $avatarData = json_decode(
                                                                                $comment->profile->avatar,
                                                                            );
                                                                            $filename = $avatarData->filename ?? null;
                                                                        @endphp
                                                                        <img src="{{ url('/storage/media/users/User_ID_' . $comment->profile->user_id . '/images/profile/' . $filename) }}"
                                                                            alt class="rounded-circle" width="33"
                                                                            height="33">
                                                                    @endif
                                                                    <h6 class="fw-semibold mb-0 fs-4">
                                                                        {{ $comment->profile->name }}</h6>
                                                                    <span class="fs-2"><span
                                                                            class="p-1 bg-muted rounded-circle d-inline-block"></span>
                                                                        {{ $comment->profile->created_at }}</span>
                                                                </div>
                                                                <p class="my-3">{{ $comment->comment }}</p>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                                            href="javascript:void(0)"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" data-bs-title="Like">
                                                                            <i class="fa fa-thumbs-up"></i>
                                                                        </a>
                                                                        <span class="text-dark fw-semibold">55</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
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
        </script>
    </body>

    </html>
@endsection
