@extends('site.layouts.layout')
@section('main')
    <style>
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
                <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('user.profile', $user_name->profile->id) }}">
                            <button
                                class="nav-link position-relative rounded-0 {{ $activeTab === 'Profile' ? 'active' : '' }} d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-profile-tab" role="tab" aria-controls="pills-profile" aria-selected="true">
                                <i class="fa fa-user me-2 fs-6"></i>
                                <span class="d-none d-md-block">Profile</span>
                            </button>
                        </a>
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
                                <i class="fas fa-paper-plane me-2 fs-6"></i> <!-- أيقونة جديدة لطلبات الصداقة المرسلة -->
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
    {{-- </div> --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="container mt-5">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-friends" role="tabpanel"
                    aria-labelledby="pills-friends-tab" tabindex="0">
                    <h3 class="mb-3 fw-semibold">Friends Requests <span
                            class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $num_of_frind_req }}</span>
                    </h3>
                    <div class="row">
                        @foreach ($friendRequests as $request)
                            <div class="col-sm-6 col-md-4 mb-4">
                                <div class="card p-2">
                                    <div class="position-relative">
                                        <div class="rounded-circle overflow-hidden"
                                            style="width: 150px; height: 150px; margin: 0 auto;">
                                            @if ($request->senderProfile->avatar == null)
                                                @if ($request->senderProfile->gender == 'male')
                                                    <a
                                                        href="{{ route('profile.other', [$request->senderProfile->name, $request->senderProfile->id]) }}">
                                                        <img src="{{ asset('images/avatar6.png') }}" alt
                                                            class="w-100 h-100"></a>
                                                @else
                                                    <a
                                                        href="{{ route('profile.other', [$request->senderProfile->name, $request->senderProfile->id]) }}">
                                                        <img src="{{ asset('images/avatar3.png') }}" alt
                                                            class="w-100 h-100"></a>
                                                @endif
                                            @else
                                                @php
                                                    // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                                                    $avatarData = json_decode($request->senderProfile->avatar);
                                                    $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                                                @endphp

                                                {{-- @if ($filename) --}}
                                                <a
                                                    href="{{ route('profile.other', [$request->senderProfile->name, $request->senderProfile->id]) }}">
                                                    <img src="{{ url('/storage/media/users/User_ID_' . $request->senderProfile->user_id . '/images/profile/' . $filename) }}"
                                                        alt="Avatar Photo" class="w-100 h-100"></a>
                                            @endif
                                        </div>
                                        {{-- <h5 class="text-center mt-2">{{ $request->senderProfile->name }}</h5> --}}
                                        @if ($request->senderProfile)
                                            <h5 class="text-center">
                                                <a href="{{ route('profile.other', [$request->senderProfile->name, $request->senderProfile->id]) }}"
                                                    class="profile-link">
                                                    {{ $request->senderProfile->name }}
                                                </a>
                                            </h5>
                                        @else
                                            <h5>
                                                <a href="#" class="profile-link">
                                                    <i class="fas fa-user-slash"></i> مستخدم غير موجود
                                                </a>
                                            </h5>
                                        @endif

                                        <form action="{{ route('friend.request.accept', $request->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i class="fas fa-user-plus"></i> قبول
                                            </button>
                                        </form>

                                        <form action="{{ route('friend.request.reject', $request->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">
                                                <i class="fas fa-user-times"></i> رفض
                                            </button>
                                        </form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
