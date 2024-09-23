@extends('site.layouts.layout')
@section('main')
    {{-- <!DOCTYPE html> --}}
    {{-- <html lang="en"> --}}

    {{-- <head> --}}
    <meta charset="utf-8">


    {{-- <title>profile with photos and posts - Bootdey.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            padding-top: 20px;
            background: #dcdcdc;
        }

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
    </style>
    {{-- </head> --}}

    <body>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color: red;font-size: 28px">{{ $error }}</p>
            @endforeach
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <img src="https://www.bootdey.com/image/1352x300/FF7F50/000000" alt class="img-fluid">
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
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                                class="w-100 h-100">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h5 class="fs-5 mb-0 fw-semibold">{{ $user_name->name }}</h5>
                                    <p class="mb-0 fs-4"></p>
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
                                <li><a href="{{ route('user.edit_profile_form', $user_name->id) }}"><button
                                            class="btn btn-primary">Edit Profile</button></a></li>
                            </ul>
                        </div>
                    </div>
                    <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2"
                        id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                <i class="fa fa-user me-2 fs-6"></i>
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
                            <button
                                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                                id="pills-friends-tab">
                                <i class="fa fa-users me-2 fs-6"></i>
                                <span class="d-none d-md-block">Friends</span>
                            </button>
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
                                    <p>{{ $user_profile->bio }}.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-briefcase text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">Sir, P P Institute Of Science</h6>
                                        </li>
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-envelope text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0"><a href="/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="39414043535657584d515857795e54585055175a5654">[email&#160;protected]</a>
                                            </h6>
                                        </li>
                                        <li class="d-flex align-items-center gap-3 mb-4">
                                            <i class="fa fa-desktop text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">www.xyz.com</h6>
                                        </li>
                                        <li class="d-flex align-items-center gap-3 mb-2">
                                            <i class="fa fa-list text-dark fs-6"></i>
                                            <h6 class="fs-4 fw-semibold mb-0">Newyork, USA - 100001</h6>
                                        </li>
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
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt
                                                class="rounded-2 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt
                                                class="rounded-2 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt
                                                class="rounded-2 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt
                                                class="rounded-2 img-fluid mb-9">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt
                                                class="rounded-2 img-fluid mb-6">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt
                                                class="rounded-2 img-fluid mb-6">
                                        </div>
                                        <div class="col-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                                class="rounded-2 img-fluid mb-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 137px"></textarea>
                                        <label for="floatingTextarea2" class="p-7">Share your thoughts</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)">
                                            <i class="fa fa-photo"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="text-dark px-3 py-2">Photo / Video</a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2">
                                            <div
                                                class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle">
                                                <i class="fa fa-list"></i>
                                            </div>
                                            <span class="text-dark">Article</span>
                                        </a>
                                        <button class="btn btn-primary ms-auto">Post</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                            class="rounded-circle" width="40" height="40">
                                        <h6 class="fw-semibold mb-0 fs-4">Mathew Anderson</h6>
                                        <span class="fs-2"><span
                                                class="p-1 bg-light rounded-circle d-inline-block"></span> 15 min
                                            ago</span>
                                    </div>
                                    <p class="text-dark my-3">
                                        Nu kek vuzkibsu mooruno ejepogojo uzjon gag fa ezik disan he nah. Wij wo pevhij
                                        tumbug rohsa ahpi ujisapse lo vap labkez eddu suk.
                                    </p>
                                    <img src="https://www.bootdey.com/image/680x380/FF7F50/000000" alt
                                        class="img-fluid rounded-4 w-100 object-fit-cover" style="height: 360px;">
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
                                            <span class="text-dark fw-semibold">2</span>
                                        </div>
                                        <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Share">
                                            <i class="fa fa-share"></i>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <div class="p-4 rounded-2 bg-light mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt
                                                    class="rounded-circle" width="33" height="33">
                                                <h6 class="fw-semibold mb-0 fs-4">Deran Mac</h6>
                                                <span class="fs-2"><span
                                                        class="p-1 bg-muted rounded-circle d-inline-block"></span> 8 min
                                                    ago</span>
                                            </div>
                                            <p class="my-3">Lufo zizrap iwofapsuk pusar luc jodawbac zi op uvezojroj
                                                duwage vuhzoc ja vawdud le furhez siva
                                                fikavu ineloh. Zot afokoge si mucuve hoikpaf adzuk zileuda falohfek zoije
                                                fuka udune lub annajor gazo
                                                conis sufur gu.
                                            </p>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Like">
                                                        <i class="fa fa-thumbs-up"></i>
                                                    </a>
                                                    <span class="text-dark fw-semibold">55</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 ms-4">
                                                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Reply">
                                                        <i class="fa fa-arrow-up"></i>
                                                    </a>
                                                    <span class="text-dark fw-semibold">0</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4 rounded-2 bg-light mb-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt
                                                    class="rounded-circle" width="33" height="33">
                                                <h6 class="fw-semibold mb-0 fs-4">Jonathan Bg</h6>
                                                <span class="fs-2"><span
                                                        class="p-1 bg-muted rounded-circle d-inline-block"></span> 5 min
                                                    ago</span>
                                            </div>
                                            <p class="my-3">
                                                Zumankeg ba lah lew ipep tino tugjekoj hosih fazjid wotmila durmuri buf hi
                                                sigapolu joit ebmi joge vo.
                                                Horemo vogo hat na ejednu sarta afaamraz zi cunidce peroido suvan podene
                                                igneve.
                                            </p>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-dark d-flex align-items-center justify-content-center bg-light-dark p-2 fs-4 rounded-circle"
                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Like">
                                                        <i class="fa fa-thumbs-up"></i>
                                                    </a>
                                                    <span class="text-dark fw-semibold">68</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 ms-4">
                                                    <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                        href="javascript:void(0)" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-title="Reply">
                                                        <i class="fa fa-arrow-up"></i>
                                                    </a>
                                                    <span class="text-dark fw-semibold">1</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4 rounded-2 bg-light ms-7">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt
                                                    class="rounded-circle" width="40" height="40">
                                                <h6 class="fw-semibold mb-0 fs-4">Carry minati</h6>
                                                <span class="fs-2"><span
                                                        class="p-1 bg-muted rounded-circle d-inline-block"></span> just
                                                    now</span>
                                            </div>
                                            <p class="my-3">
                                                Olte ni somvukab ugura ovaobeco hakgoc miha peztajo tawosu udbacas kismakin
                                                hi. Dej
                                                zetfamu cevufi sokbid bud mun soimeuha pokahram vehurpar keecris pepab
                                                voegmud
                                                zundafhef hej pe.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 p-3">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                        class="rounded-circle" width="33" height="33">


                                    {{-- لهون وصلت باقي انسخلو من هون لتحت --}}


                                    <input type="text" class="form-control py-8" id="exampleInputtext"
                                        aria-describedby="textHelp" placeholder="Comment">
                                    <button class="btn btn-primary">Comment</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt
                                            class="rounded-circle" width="40" height="40">
                                        <h6 class="fw-semibold mb-0 fs-4">Carry Minati</h6>
                                        <span class="fs-2"><span
                                                class="p-1 bg-light rounded-circle d-inline-block"></span> now</span>
                                    </div>
                                    <p class="text-dark my-3">
                                        Pucnus taw set babu lasufot lawdebuw nem ig bopnub notavfe pe ranlu dijsan liwfekaj
                                        lo az. Dom giat gu
                                        sehiosi bikelu lo eb uwrerej bih woppoawi wijdiola iknem hih suzega gojmev kir
                                        rigoj.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Like">
                                                <i class="fa fa-thumbs-up"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">1</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 ms-4">
                                            <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Comment">
                                                <i class="fa fa-comments"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">0</span>
                                        </div>
                                        <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Share">
                                            <i class="fa fa-share"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 p-3">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt
                                        class="rounded-circle" width="33" height="33">
                                    <input type="text" class="form-control py-8" id="exampleInputtext"
                                        aria-describedby="textHelp" placeholder="Comment">
                                    <button class="btn btn-primary">Comment</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt
                                            class="rounded-circle" width="40" height="40">
                                        <h6 class="fw-semibold mb-0 fs-4">Genelia Desouza</h6>
                                        <span class="fs-2"><span
                                                class="p-1 bg-light rounded-circle d-inline-block"></span> 15 min
                                            ago</span>
                                    </div>
                                    <p class="text-dark my-3">
                                        Faco kiswuoti mucurvi juokomo fobgi aze huweik zazjofefa kuujer talmoc li niczot
                                        lohejbo vozev zi huto. Ju
                                        tupma uwujate bevolkoh hob munuap lirec zak ja li hotlanu pigtunu.
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt
                                                class="img-fluid rounded-4 mb-3 mb-sm-0">
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt
                                                class="img-fluid rounded-4">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <a class="text-dark d-flex align-items-center justify-content-center bg-light p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Like">
                                                <i class="fa fa-thumbs-up"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">320</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 ms-4">
                                            <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Comment">
                                                <i class="fa fa-comments"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">1</span>
                                        </div>
                                        <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Share">
                                            <i class="fa fa-share"></i>
                                        </a>
                                    </div>
                                    <div class="p-4 rounded-2 bg-light">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt
                                                class="rounded-circle" width="33" height="33">
                                            <h6 class="fw-semibold mb-0 fs-4">Ritesh Deshmukh</h6>
                                            <span class="fs-2"><span
                                                    class="p-1 bg-muted rounded-circle d-inline-block"></span> 15 min
                                                ago</span>
                                        </div>
                                        <p class="my-3">
                                            Hintib cojno riv ze heb cipcep fij wo tufinpu bephekdab infule pajnaji. Jiran
                                            goetimip muovo go en
                                            gaga zeljomim hozlu lezuvi ehkapod dec bifoom hag dootasac odo luvgit ti ella.
                                        </p>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Like">
                                                    <i class="fa fa-thumbs-up"></i>
                                                </a>
                                                <span class="text-dark fw-semibold">65</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 ms-4">
                                                <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                    href="javascript:void(0)" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Reply">
                                                    <i class="fa fa-arrow-up"></i>
                                                </a>
                                                <span class="text-dark fw-semibold">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 p-3">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt
                                        class="rounded-circle" width="33" height="33">
                                    <input type="text" class="form-control py-8" id="exampleInputtext"
                                        aria-describedby="textHelp" placeholder="Comment">
                                    <button class="btn btn-primary">Comment</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                            class="rounded-circle" width="40" height="40">
                                        <h6 class="fw-semibold mb-0 fs-4">Mathew Anderson</h6>
                                        <span class="fs-2"><span
                                                class="p-1 bg-light rounded-circle d-inline-block"></span> 15 min
                                            ago</span>
                                    </div>
                                    <p class="text-dark my-3">
                                        Faco kiswuoti mucurvi juokomo fobgi aze huweik zazjofefa kuujer talmoc li niczot
                                        lohejbo vozev zi huto. Ju
                                        tupma uwujate bevolkoh hob munuap lirec zak ja li hotlanu pigtunu.
                                    </p>
                                    <img src="https://www.bootdey.com/image/680x380/FF7F50/000000" alt
                                        class="img-fluid rounded-4 w-100 object-fit-cover mb-4" style="height: 360px;">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Like">
                                                <i class="fa fa-thumbs-up"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">129</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 ms-4">
                                            <a class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle"
                                                href="javascript:void(0)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Comment">
                                                <i class="fa fa-comments"></i>
                                            </a>
                                            <span class="text-dark fw-semibold">0</span>
                                        </div>
                                        <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle"
                                            href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Share">
                                            <i class="fa fa-share"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 p-3">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                        class="rounded-circle" width="33" height="33">
                                    <input type="text" class="form-control py-8" id="exampleInputtext"
                                        aria-describedby="textHelp" placeholder="Comment">
                                    <button class="btn btn-primary">Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"></script>
    </body>

    </html>
@endsection