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
        <h3>طلبات الصداقة</h3>
        @foreach ($friendRequests as $request)
            {{-- @dd($request->senderProfile->id) --}}
            {{-- @dd($request->senderProfile->name) --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="people-nearby">
                        <div class="nearby-user">
                            <div class="row">
                                <div class="col-md-2 col-sm-2">
                                    @if ($request->senderProfile->avatar == null)
                                        @if ($request->senderProfile->gender == 'male')
                                            <img src="{{ asset('images/avatar6.png') }}" alt class="w-100 h-100">
                                        @else
                                            <img src="{{ asset('images/avatar3.png') }}" alt class="w-100 h-100">
                                        @endif
                                    @else
                                        @php
                                            // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                                            $avatarData = json_decode($request->senderProfile->avatar);
                                            $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                                        @endphp

                                        {{-- @if ($filename) --}}
                                        <img src="{{ url('/storage/media/users/User_ID_' . $request->senderProfile->user_id . '/images/profile/' . $filename) }}"
                                            alt="Avatar Photo" class="w-100 h-100">
                                    @endif
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    @if ($request->senderProfile)
                                        <h5><a href="{{ route('profile.other', [$request->senderProfile->name, $request->senderProfile->id]) }}" class="profile-link">{{ $request->senderProfile->name }}</a>
                                        </h5>
                                    @else
                                        <h5><a href="#" class="profile-link">مستخدم غير موجود</a></h5>
                                    @endif
                                    <p>{{ $request->senderProfile->professional_title }}</p>
                                    <p class="text-muted"></p>
                                    <!-- يمكنك تعديل هذه القيمة حسب البيانات المتوفرة -->
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <form action="{{ route('friend.request.accept', $request->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary pull-right">قبول</button>
                                    </form>
                                    <form action="{{ route('friend.request.reject', $request->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger pull-right">رفض</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
