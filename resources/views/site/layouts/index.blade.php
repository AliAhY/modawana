@extends('site.layouts.layout')

@section('main')
    <div class="container">
        <div class="row">
            @foreach ($profiles as $profile)
                <div class="col-4 right-col mb-4">
                    <div class="article border rounded-lg shadow-lg overflow-hidden">
                        <div class="image-container">
                            {{-- @if ($book->image)
                                <img src="{{ url('/storage/media/books/' . $book->image) }}" alt="{{ $book->title }}"
                                    style="width:100%; height:auto;">
                            @else
                                <img src="/path/to/default/image.jpg" alt="Default Image" class="w-full h-48 object-cover">
                                <!-- استخدم صورة افتراضية إذا لم تكن متوفرة -->
                            @endif --}}
                            @if ($profile->avatar == null)
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="w-100 h-100">
                            @else
                                @php
                                    // تحليل قيمة avatar (JSON) لاسترداد اسم الملف
                                    $avatarData = json_decode($profile->avatar);
                                    $filename = $avatarData->filename ?? null; // التأكد من وجود البيانات
                                @endphp

                                {{-- @if ($filename) --}}
                                <img src="{{ url('/storage/media/users/' . $profile->name . '/images/profile/' . $filename) }}"
                                    alt="Avatar Photo" class="w-100 h-100">
                            @endif
                        </div>
                        <div class="text p-4"  style="text-align: center">
                            <a href="#" class="text-blue-600 hover:underline">
                                {{-- <h4 class="text-lg font-semibold">{{ $book->title }}</h4> --}}
                            </a>
                            <p class="text-gray-600 text-sm"> <span class="font-medium">{{ $profile->name }}</span></p>
                            {{-- <p class="date text-gray-500 text-xs">{{ $book->created_at->format('d-m-Y') }}</p> --}}
                            <!-- التاريخ يمكنك تغييره حسب الحاجة -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
