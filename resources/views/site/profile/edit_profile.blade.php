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


        .form-group {
            margin: 10px;
            /* مسافة داخل البطاقة */
        }

        .text-center {
            margin-top: 20px;
            /* إضافة مسافة لتحسين الشكل */
        }

        #profile-preview {
            display: flex;
            justify-content: center;
            /* تمركز أفقي */
            align-items: center;
            /* تمركز عمودي إذا لزم الأمر */
            margin-bottom: 15px;
            /* إضافة مساحة تحت الصورة */
        }

        .profile-photo {
            width: 300px;
            /* عرض ثابت */
            height: 300px;
            /* طول ثابت */
            border-radius: 50%;
            /* دائري */
            object-fit: cover;
            /* يضمن أن الصورة تغطي المساحة */
            margin-bottom: 15px;
        }

        .cover-photo {
            width: 100%;
            /* عرض الغلاف */
            height: auto;
            /* ارتفاع تلقائي */
            border-radius: 15px;
            /* زوايا مستديرة */
            margin-bottom: 20px;
            /* مسافة أسفل الصورة */
            object-fit: cover;
            /* يضمن أن الصورة تغطي المساحة */
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
                <div id="profile-preview">
                    <img src="https://via.placeholder.com/300x300" class="profile-photo rounded-circle" alt="Profile Photo">
                </div>
                <h6 class="mt-2">رفع صورة مختلفة...</h6>
                <input type="file" class="form-control mb-3" name="image" id="image" required>
            </div>
        </div>
        <!-- بطاقة صورة الغلاف -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <div id="cover-preview">
                    <img src="https://via.placeholder.com/1352x300" class="cover-photo" alt="Cover Photo"
                        style="max-width: 100%; height: auto;">
                </div>
                <h6 class="mt-2">رفع صورة مختلفة...</h6>
                <input type="file" class="form-control mb-3" name="cover_image" id="cover_image" accept="image/*"
                    required>
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
        const userId = {{ $user_profile->id }}; 
        // إعدادات لرفع صورة الملف الشخصي  
        const inputElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(inputElement);
        pond.setOptions({
            server: {
                url: '{{ route('upload.profile', ['id' => ':id']) }}'.replace(':id', userId),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        pond.on('addfile', (error, file) => {
            if (error) {
                console.error('Error adding file:', error);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const coverPreviewImg = document.querySelector('#profile-preview img');

                // تحديث مصدر الصورة  
                coverPreviewImg.src = e.target.result; // تعيين مصدر الصورة  
                coverPreviewImg.style.display = "block"; // إظهار صورة المعاينة بعد رفعها  
            };
            reader.readAsDataURL(file.file); // قراءة الملف كـ Data URL  
        });

        // إعدادات لرفع صورة الغلاف  
        const inputElement1 = document.querySelector('input[id="cover_image"]');
        const pond1 = FilePond.create(inputElement1);
        pond1.setOptions({
            server: {
                url: '{{ route('upload.cover', ['id' => ':id']) }}'.replace(':id', userId),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        pond1.on('addfile', (error, file) => {
            if (error) {
                console.error('Error adding file:', error);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const coverPreviewImg = document.querySelector('#cover-preview img');

                // تحديث مصدر الصورة  
                coverPreviewImg.src = e.target.result; // تعيين مصدر الصورة  
                coverPreviewImg.style.display = "block"; // إظهار صورة المعاينة بعد رفعها  

                // تعيين الخصائص المطلوبة مباشرة  
                // التأكد من أن الصورة تتناسب مع مظهر الصورة الافتراضية   
                coverPreviewImg.style.width = "100%"; // عرض 100%  
                coverPreviewImg.style.height = "auto"; // ارتفاع تلقائي  
                coverPreviewImg.style.borderRadius = "15px"; // زوايا دائرية  
                coverPreviewImg.style.objectFit = "cover"; // تأكد من تغطية المساحة   
            };
            reader.readAsDataURL(file.file); // قراءة الملف كـ Data URL  
        });
    </script>
@endsection
