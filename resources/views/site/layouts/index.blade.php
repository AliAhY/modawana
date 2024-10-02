@extends('site.layouts.layout')

@section('main')
    <div class="container">
        <div class="row">
            @foreach ($profiles as $profile)
                <div class="col-4 right-col mb-4">
                    <div class="article border rounded-lg shadow-lg overflow-hidden">
                        <div class="image-container">
                            @if ($profile->avatar == null)
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="w-100 h-100">
                            @else
                                @php
                                    // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                                    $avatarData = json_decode($profile->avatar);
                                    $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                                @endphp
                                <img src="{{ url('/storage/media/users/User_ID_' . $profile->user_id . '/images/profile/' . $filename) }}"
                                    alt="Avatar Photo" class="w-100 h-100">
                            @endif
                            {{-- @endif --}}
                        </div>
                        <div class="text p-4" style="text-align: center">
                            <a href="#" class="text-blue-600 hover:underline">
                                {{-- <h4 class="text-lg font-semibold"><a href="{{route('profile.other', $profile->name)}}">{{ $profile->name }}</a></h4> --}}
                            </a>
                            <p class="text-gray-600 text-sm"><span class="font-medium">{{ $profile->name }}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
