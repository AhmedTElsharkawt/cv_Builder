<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صانع السيرة الذاتية</title>

    <!-- Bootstrap CSS (اختياري) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- أي CSS إضافي -->
    <style>

    /* @font-face {
        font-family: 'Cairo';
        src: url("{{ storage_path('fonts/Cairo-Regular.ttf') }}") format('truetype');
    } */

        body {
            font-family: 'dejavu sans';
            direction: rtl;
            background-color: #f8f9fa;
        }

    </style>

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">السيرة الذاتية</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cvSectionsNavbar" aria-controls="cvSectionsNavbar" aria-expanded="false" aria-label="تبديل القائمة">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="cvSectionsNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item"><a href="{{ route('cvbuilder.personal_info.edit') }}" class="nav-link">البيانات الشخصية</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.educations.edit') }}" class="nav-link">المؤهلات</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.experiences.edit') }}" class="nav-link">الخبرات</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.trainings.edit') }}" class="nav-link">الدورات</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.skills.edit') }}" class="nav-link">المهارات</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.projects.edit') }}" class="nav-link">المشاريع</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.languages.edit') }}" class="nav-link">اللغات</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.links.edit') }}" class="nav-link">الروابط</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.address.edit') }}" class="nav-link">العنوان</a></li>
                    <li class="nav-item"><a href="{{ route('cvbuilder.templates.index') }}" class="nav-link">القوالب</a></li>

                </ul>
            </div>
        </div>
    </nav>



    <!-- محتوى الصفحة -->
    <main class="container" style="padding-top: 70px;">
        @yield('content')
    </main>

    <!-- Bootstrap JS (اختياري) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
