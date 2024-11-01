<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الرئيسية</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('filepond/filepond.min.css') }}">

    <script src="{{ asset('filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <style>
        /* html,
        body {

            background-color: rgba(195, 190, 189, 0.511);
        } */

        .profile-photo1 {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 15px;
        }

        .aaa {
            display: flex;
            min-height: 100vh;
            /* width: 100%; */

        }

        .sidebar {
            width: 150px;
            background-color: rgba(195, 190, 189, 0.511);
            border-right: 1px solid #ddd;
            transition: width 0.3s;
        }

        .main-content {
            flex: 1;
            padding: 15px;
            transition: margin-left 0.3s;
        }

        .sidebar.hidden {
            width: 60px;
        }

        .sidebar.hidden~.main-content {
            margin-left: 60px;
            /* Adjust this value to match the width of the hidden sidebar */
        }

        .sidebar-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 40px;
            /* Adjust height as needed */
        }

        .nav-item {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-text {
            display: block;
            transition: opacity 0.3s;
            opacity: 1;
        }

        .sidebar.hidden .nav-text {
            opacity: 0;
            pointer-events: none;
            /* Prevent mouse events on hidden text */
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }

        .search-container input {
            width: 300px;
            margin-bottom: 10px;
        }

        .footer-content {
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body style="background-color: rgba(195, 190, 189, 0.511)">
    <nav class="navbar navbar-expand-lg navbar-light" style=" rgba(195, 190, 189, 0.511)">
        <a class="navbar-brand" href="{{ url('/') }}">
            @if (isset($user_name) && isset($user_name->profile) && $user_name->profile->avatar !== null)
                @php
                    $avatarData = json_decode($user_name->profile->avatar);
                    $filename = $avatarData->filename ?? null;
                @endphp
                <img src="{{ $filename ? url('/storage/media/users/User_ID_' . $user_name->profile->user_id . '/images/profile/' . $filename) : asset($user_name->gender == 'male' ? 'images/avatar6.png' : 'images/avatar3.png') }}"
                    alt="Avatar Photo" class="profile-photo1">
            @endif
        </a>

        <form class="d-flex mx-auto">
            <div class="search-container" style="position: relative;">
                <input type="search" class="form-control" placeholder="ابحث هنا" aria-label="Search">
                <div id="searchResults" style="width: 300px; position: absolute; z-index: 1000;"></div>
            </div>
        </form>

        @if (Auth::check())
            <ul class="navbar-nav ml-auto" style="margin-right: 30px">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id) }}">الملف الشخصي</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">تسجيل الخروج</a>
                    </div>
                </li>
            </ul>
        @endif
    </nav>

    <div class="aaa" style="background-color: background-color: rgba(195, 190, 189, 0.511)">
        <div class="sidebar" id="sidebar">
            <button id="toggle-sidebar" class="btn btn-light" style="width: 100%;">☰</button>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">الرئيسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <span class="nav-text">مساعدة</span>
                        <i class="fas fa-help"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">تسجيل الخروج</span>
                    </a>
                </li>
            </ul>
        </div>

        <div style="width: 100%;background-color: rgba(195, 190, 189, 0.511)">
            @yield('main')
        </div>
    </div>

    <div class="footer-content" style="background-color: rgba(195, 190, 189, 0.995);">
        <div class="row">
            <div class="col-12 col-md-6">
                <p>&copy; 2024YTP. جميع الحقوق محفوظة.</p>
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
                        style="background-color: rgb(129, 127, 123)"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');

            sidebar.classList.toggle('hidden'); // تفعيل/إلغاء تفعيل فئة hidden  

            const isHidden = sidebar.classList.contains('hidden');

            // Resize main content based on sidebar visibility  
            mainContent.style.marginLeft = isHidden ? '60px' :
            '150px'; // Adjust this value based on sidebar width  
        });
    </script>
</body>

</html>
