<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الرئيسية</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('filepond/filepond.min.css') }}">

    <script src="{{ asset('filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    @yield('cssAndJs')

</head>
<style>
    .profile-photo1 {
        width: 60px;
        /* عرض ثابت */
        height: 60px;
        /* طول ثابت */
        border-radius: 50%;
        /* دائري */
        object-fit: cover;
        /* يضمن أن الصورة تغطي المساحة */
        margin-bottom: 15px;
    }
</style>

<body>


    <nav class="navbar navbar-expand-lg navbar-light  navbar-fixed"
        style="background-color: rgba(195, 190, 189, 0.511)">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- @dd($user_name) --}}
            @if (isset($user_name) && isset($user_name->profile) && $user_name->profile->avatar !== null)
                @php
                    // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                    $avatarData = json_decode($user_name->profile->avatar);
                    $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                @endphp

                @if ($filename)
                    <img src="{{ url('/storage/media/users/User_ID_' . $user_name->profile->user_id . '/images/profile/' . $filename) }}"
                        alt="Avatar Photo" class="profile-photo1">
                @else
                    @if ($user_name->gender == 'male')
                        <img src="{{ asset('images/avatar6.png') }}" alt class="w-100 h-100">
                    @else
                        <img src="{{ asset('images/avatar3.png') }}" alt class="w-100 h-100">
                    @endif
                    {{-- <img src="{{ asset('images/undraw_profile.svg') }}" class="profile-photo1" alt="شعار" /> --}}
                @endif
            @else
                {{-- لا تظهر الصورة إذا كان المستخدم غير مسجل أو ليس له صورة شخصية --}}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>

        <form class="d-flex">
            <div class="search-container" style="position: relative;">
                <input type="search" class="form-control me-4" id="search" style="width: 300px;"
                    placeholder="بحث...">
                <div id="searchResults" style="width: 300px"></div>
            </div>

        </form>
        @if (Auth::check())
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a href="{{ route('user.profile', Auth::user()->id) }}" class="nav-link">
                        {{ $user_name->profile->name }}
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        @else
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ url('/register') }}">Sign up</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                </li>
            </ul>
        @endif
    </nav>

    <div class="p-2">
        @yield('main')
    </div>


    <div class="footer-content " style="background-color: rgba(195, 190, 189, 0.995)">
        <div class="row">
            <div class="col-12 col-md-6">
                <p>&copy; 2023 YTP. جميع الحقوق محفوظة.</p>
            </div>
            <div class="col-12 col-md-6 footer-right text-right">
                <a href="https://www.facebook.com/yourprofile" target="_blank">
                    <i class="fab fa-facebook-square mx-2" aria-hidden="true"></i>
                </a>
                <a href="https://twitter.com/yourprofile" target="_blank">
                    <i class="fab fa-twitter-square mx-2" aria-hidden="true"></i>
                </a>
                <a href="https://www.instagram.com/yourprofile" target="_blank" style="text-decoration: none">
                    <i class="fab fa-instagram-square mx-2" aria-hidden="true"
                        style="background-color: rgb(243, 173, 61)"></i>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
