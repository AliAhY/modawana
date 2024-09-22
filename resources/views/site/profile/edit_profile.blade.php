@extends('site.layouts.layout')
@section('main')
    <style>
        .card {
            margin-bottom: 15px;
            /* مسافة بين البطاقات */
        }

        .cover-photo {
            width: 100%;
            height: auto;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .form-group {
            margin: 10px;
            /* مسافة داخل البطاقة */
        }

        .text-center {
            margin-top: 20px;
            /* إضافة مسافة لتحسين الشكل */
        }
    </style>

    <div class="container">
        <h1 class="text-primary">Edit Profile</h1>
        <hr>

        <!-- نموذج رفع الصورة -->
        {{-- <form action="{{ route('update.profile', $id) }}" method="POST" enctype="multipart/form-data"> --}}
        @csrf <!-- إذا كنت تستخدم Laravel، تأكد من إضافة مدير الحماية CSRF -->

        <!-- بطاقة صورة البروفايل -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="https://via.placeholder.com/150" class="profile-photo rounded-circle" alt="Profile Photo">
                <h6 class="mt-2">رفع صورة مختلفة...</h6>
                <input type="file" class="form-control mb-3" name="image" id="image" required>
            </div>
        </div>

        <!-- بطاقة صورة الغلاف -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="https://via.placeholder.com/1352x300" class="cover-photo" alt="Cover Photo">
                <h6 class="mt-2">رفع صورة مختلفة...</h6>
                <input type="file" class="form-control mb-3" name="cover_image" id="cover_image" required>
            </div>
        </div>

        <div class="row">
            <!-- حقول النموذج -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Full name:</label>
                            <input class="form-control" type="text" name="name" value="dey-dey" required>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Bio:</label>
                            <textarea class="form-control" name="bio"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Skills:</label>
                            <input class="form-control" type="text" name="skills" value="">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>School name:</label>
                            <input class="form-control" type="text" name="school_name" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Professional title:</label>
                            <input class="form-control" type="text" name="professional_title" value="dey-dey">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Date of birth:</label>
                            <input class="form-control" type="date" name="date_of_birth">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Interests:</label>
                            <input class="form-control" type="text" name="interests" value="">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Location:</label>
                            <input class="form-control" type="text" name="location" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Universe name:</label>
                            <input class="form-control" type="text" name="universe_name" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Phone Number:</label>
                            <input class="form-control" type="number" name="phone_number" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button> <!-- زر إرسال -->
        </div>
        </form>
    </div>

    <script>
        const userId = {{ $user_profile->id }}; // تأكد من أن قيمته صحيحة  
        const inputElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '{{ route('upload.profile', ['id' => ':id']) }}'.replace(':id', userId),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>

    <script>
        const userId1 = {{ $user_profile->id }}; // تأكد من أن قيمته صحيحة
        const inputElement1 = document.querySelector('input[id="cover_image"]');
        const pond1 = FilePond.create(inputElement1);
        FilePond.setOptions({
            server: {
                url: '{{ route('upload.cover', ['id' => ':id']) }}'.replace(':id', userId1),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endsection
