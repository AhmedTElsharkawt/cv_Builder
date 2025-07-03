<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}</title>

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
    <!-- محتوى الصفحة -->
    <main class="container">
        <style>
            /* Styles for CV template matching provided design */

            .cv-wrapper {
                display: flex;
                gap: 1rem;
                margin-top: 2rem;
            }
            .cv-sidebar {
                flex: 0 0 30%;
                background-color: #e3f2fd;
                padding: 1rem;
                border-radius: 8px;
                text-align: center;
            }
            .cv-main {
                flex: 1;
                background-color: #fff;
                padding: 1rem;
                border-radius: 8px;
            }
            .profile-img {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                object-fit: cover;
                margin: 0 auto 1rem;
            }
            .name-title {
                margin-bottom: 1rem;
            }
            .name-title h2 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: bold;
            }
            .name-title p {
                margin: 0;
                color: #555;
            }
            .summary {
                margin-top: 1rem;
                text-align: left;
                color: #333;
            }
            .contact-section {
                margin-top: 2rem;
                text-align: left;
            }
            .contact-section h5 {
                background-color: #bbdefb;
                padding: 0.5rem;
                border-radius: 4px;
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            .contact-section ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .contact-section li {
                display: flex;
                align-items: center;
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
                color: #333;
            }
            .contact-section li i {
                margin-right: 0.5rem;
                color: #1976d2;
            }
            .section {
                margin-bottom: 2rem;
            }
            .section-title {
                background-color: #bbdefb;
                padding: 0.5rem;
                border-radius: 4px;
                font-size: 1.1rem;
                font-weight: bold;
                margin-bottom: 1rem;
                display: inline-block;
            }
            .entry {
                margin-bottom: 1rem;
                text-align: left;
            }
            .entry .entry-title {
                font-weight: bold;
                font-size: 1rem;
                margin-bottom: 0.25rem;
            }
            .entry .entry-subtitle {
                font-size: 0.9rem;
                color: #555;
                margin-bottom: 0.25rem;
            }
            .entry .entry-date {
                font-size: 0.8rem;
                color: #777;
                margin-bottom: 0.25rem;
            }
            .entry .entry-desc {
                font-size: 0.9rem;
                color: #333;
            }
        </style>

        <div class="container">

            <div class="cv-wrapper">
                <!-- Sidebar -->
                <div class="cv-sidebar">
                    @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->profile_image)
                        <img src="{{ asset('storage/' . $user->cvPersonalInfo->profile_image) }}" alt="Profile Image" class="profile-img">
                    @endif
                    <div class="name-title">
                        <h2>{{ $user->name }}</h2>
                        @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->job_title)
                            <p>{{ $user->cvPersonalInfo->job_title }}</p>
                        @endif
                    </div>
                    @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->bio)
                    <div class="summary">
                        <p>{{ $user->cvPersonalInfo->bio }}</p>
                    </div>
                    @endif

                    <div class="contact-section">
                        <h5>معلومات الاتصال</h5>
                        <ul>
                            @if(isset($user->phone_number))
                            <li><i class="bi bi-telephone"></i> {{ $user->phone_number }}</li>
                            @endif
                            <li><i class="bi bi-envelope"></i> {{ $user->email }}</li>
                            @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->gender)
                            <li><i class="bi bi-gender-ambiguous"></i> {{ $user->cvPersonalInfo->gender }}</li>
                            @endif
                            @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->birth_date)
                            <li><i class="bi bi-calendar"></i> {{ $user->cvPersonalInfo->birth_date }}</li>
                            @endif
                            @if(isset($user->address) && $user->address->full_address)
                            <li><i class="bi bi-geo-alt"></i> {{ $user->address->full_address }}</li>
                            @endif
                            @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->nationality)
                            <li><i class="bi bi-flag"></i> {{ $user->cvPersonalInfo->nationality }}</li>
                            @endif
                            @if(isset($user->cvPersonalInfo) && $user->cvPersonalInfo->country)
                            <li><i class="bi bi-globe"></i> {{ $user->cvPersonalInfo->country }}</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="cv-main">
                    <!-- Experiences -->
                    @if($user->cvExperiences && $user->cvExperiences->count())
                    <div class="section">
                        <div class="section-title">الخبرات العملية</div>
                        @foreach($user->cvExperiences as $exp)
                        <div class="entry">
                            <div class="entry-title">{{ $exp->company }}</div>
                            @if($exp->position)
                            <div class="entry-subtitle">{{ $exp->position }}</div>
                            @endif
                            @if($exp->start_date || $exp->end_date)
                            <div class="entry-date">{{ $exp->start_date ?? '' }} - {{ $exp->end_date ?? 'Present' }}</div>
                            @endif
                            @if($exp->description)
                            <div class="entry-desc">{{ $exp->description }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Education -->
                    @if($user->cvEducations && $user->cvEducations->count())
                    <div class="section">
                        <div class="section-title">المؤهلات العلمية</div>
                        @foreach($user->cvEducations as $edu)
                        <div class="entry">
                            <div class="entry-title">{{ $edu->institution }}</div>
                            @if($edu->major)
                            <div class="entry-subtitle">{{ $edu->major }}</div>
                            @endif
                            @if($edu->graduation_date)
                            <div class="entry-date">{{ $edu->graduation_date }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Skills -->
                    @if($user->cvSkills && $user->cvSkills->count())
                    <div class="section">
                        <div class="section-title">المهارات</div>
                        <ul>
                            @foreach($user->cvSkills as $skill)
                                <li>{{ $skill->name }} ({{ $skill->level }})</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Languages -->
                    @if($user->cvLanguages && $user->cvLanguages->count())
                    <div class="section">
                        <div class="section-title">اللغات</div>
                        <ul>
                            @foreach($user->cvLanguages as $lang)
                                <li>{{ $lang->name }} ({{ $lang->proficiency }})</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Projects -->
                    @if($user->cvProjects && $user->cvProjects->count())
                    <div class="section">
                        <div class="section-title">الأعمال / المشاريع</div>
                        @foreach($user->cvProjects as $proj)
                        <div class="entry">
                            <div class="entry-title">{{ $proj->name }}</div>
                            @if($proj->completion_date)
                            <div class="entry-date">{{ $proj->completion_date }}</div>
                            @endif
                            @if($proj->description)
                            <div class="entry-desc">{{ $proj->description }}</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Trainings/Courses -->
                    @if($user->cvTrainings && $user->cvTrainings->count())
                    <div class="section">
                        <div class="section-title">الدورات التدريبية</div>
                        @foreach($user->cvTrainings as $course)
                            <div class="entry">
                                <div class="entry-title">{{ $course->title }}</div>
                                @if($course->provider)
                                <div class="entry-subtitle">{{ $course->provider }}</div>
                                @endif
                                @if($course->date)
                                <div class="entry-date">{{ $course->date }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Links -->
                    @if($user->cvLinks && $user->cvLinks->count())
                    <div class="section">
                        <div class="section-title">روابط مهمة</div>
                        <ul>
                            @foreach($user->cvLinks as $link)
                                <li><a href="{{ $link->url }}" target="_blank">{{ $link->label }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Address -->
                    @if(isset($user->cvAddress) && $user->cvAddress->full_address)
                    <div class="section">
                        <div class="section-title">العنوان</div>
                        <div class="entry-desc">{{ $user->cvAddress->full_address }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS (اختياري) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
