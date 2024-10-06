@extends('site.layouts.layout')
@section('main')
    <style>
        body {
            margin-top: 20px;
            background: #FAFAFA;
        }

        /*==================================================
              Nearby People CSS
        ==================================================*/

        .people-nearby .google-maps {
            background: #f8f8f8;
            border-radius: 4px;
            border: 1px solid #f1f2f2;
            padding: 20px;
            margin-bottom: 20px;
        }

        .people-nearby .google-maps .map {
            height: 300px;
            width: 100%;
            border: none;
        }

        .people-nearby .nearby-user {
            padding: 20px 0;
            border-top: 1px solid #f1f2f2;
            border-bottom: 1px solid #f1f2f2;
            margin-bottom: 20px;
        }

        img.profile-photo-lg {
            height: 80px;
            width: 80px;
            border-radius: 50%;
        }
    </style>
    <div class="container mt-4">
        <h3>أصدقائك</h3>
        {{-- @dd($friendRequests->profile) --}}
        {{-- @dd($request->friendProfile) --}}
        @foreach ($friendRequests as $request)
            {{-- @dd($request) --}}
            {{-- @dd($request->senderProfile->name) --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="people-nearby">
                        <div class="nearby-user">
                            <div class="row">
                                <div class="col-md-2 col-sm-2">
                                    @if ($request->friendProfile->avatar == null)
                                        @if ($request->friendProfile->gender == 'male')
                                            <img src="{{ asset('images/avatar6.png') }}" alt class="w-100 h-100">
                                        @else
                                            <img src="{{ asset('images/avatar3.png') }}" alt class="w-100 h-100">
                                        @endif
                                    @else
                                        @php
                                            // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                                            $avatarData = json_decode($request->friendProfile->avatar);
                                            $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                                        @endphp

                                        {{-- @if ($filename) --}}
                                        <img src="{{ url('/storage/media/users/User_ID_' . $request->friendProfile->user_id . '/images/profile/' . $filename) }}"
                                            alt="Avatar Photo" class="w-100 h-100">
                                    @endif
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    @if ($request->friendProfile)
                                        <h5><a href="{{ route('profile.other', [$request->friendProfile->name, $request->friendProfile->id]) }}" class="profile-link">{{ $request->friendProfile->name }}</a>
                                        </h5>
                                    @else
                                        <h5><a href="#" class="profile-link">مستخدم غير موجود</a></h5>
                                    @endif
                                    <p>{{ $request->friendProfile->professional_title }}</p>
                                    <p class="text-muted"></p>
                                    <!-- يمكنك تعديل هذه القيمة حسب البيانات المتوفرة -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
