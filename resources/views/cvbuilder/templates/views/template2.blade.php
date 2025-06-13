@extends('layouts.app')

@section('content')
<style>
    .cv-template-2 {
        font-family: Arial, sans-serif;
        background: #f7f7f7;
        padding: 2rem;
    }
    .header {
        background: #222;
        color: #fff;
        padding: 1.5rem;
        text-align: center;
    }
    .header h1 {
        margin: 0;
        font-size: 2rem;
    }
    .header p {
        margin: 0.25rem 0;
        font-size: 1.1rem;
    }
    .container {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
    }
    .left-col {
        width: 35%;
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
    }
    .right-col {
        width: 65%;
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
    }
    .section-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #222;
        border-bottom: 2px solid #ccc;
        padding-bottom: 0.25rem;
    }
    .entry {
        margin-bottom: 1rem;
    }
    .entry-title {
        font-weight: bold;
        font-size: 1rem;
    }
    .entry-subtitle, .entry-date, .entry-desc {
        font-size: 0.9rem;
        color: #444;
    }
    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin: 0 auto 1rem;
    }
    ul {
        list-style: none;
        padding: 0;
    }
</style>

<div class="cv-template-2">
    <!-- Header -->
    <div class="header">
        <h1>{{ $user->name }}</h1>
        @if($user->cvPersonalInfo?->job_title)
            <p>{{ $user->cvPersonalInfo->job_title }}</p>
        @endif
        @if($user->cvPersonalInfo?->bio)
            <p>{{ $user->cvPersonalInfo->bio }}</p>
        @endif
    </div>

    <div class="container">
        <!-- Left Column -->
        <div class="left-col">
            @if($user->cvPersonalInfo?->profile_image)
                <img src="{{ asset('storage/' . $user->cvPersonalInfo->profile_image) }}" alt="Profile" class="profile-img">
            @endif

            <div class="section">
                <div class="section-title">معلومات الاتصال</div>
                <ul>
                    @if($user->email)
                        <li><strong>البريد:</strong> {{ $user->email }}</li>
                    @endif
                    @if($user->phone_number)
                        <li><strong>الهاتف:</strong> {{ $user->phone_number }}</li>
                    @endif
                    @if($user->cvPersonalInfo?->gender)
                        <li><strong>الجنس:</strong> {{ $user->cvPersonalInfo->gender }}</li>
                    @endif
                    @if($user->cvPersonalInfo?->birth_date)
                        <li><strong>تاريخ الميلاد:</strong> {{ $user->cvPersonalInfo->birth_date }}</li>
                    @endif
                    @if($user->cvPersonalInfo?->country)
                        <li><strong>الدولة:</strong> {{ $user->cvPersonalInfo->country }}</li>
                    @endif
                    @if($user->cvPersonalInfo?->nationality)
                        <li><strong>الجنسية:</strong> {{ $user->cvPersonalInfo->nationality }}</li>
                    @endif
                    @if($user->cvAddress?->full_address)
                        <li><strong>العنوان:</strong> {{ $user->cvAddress->full_address }}</li>
                    @endif
                </ul>
            </div>

            @if($user->cvSkills?->count())
            <div class="section">
                <div class="section-title">المهارات</div>
                <ul>
                    @foreach($user->cvSkills as $skill)
                        <li>{{ $skill->name }} - {{ $skill->level }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($user->cvLanguages?->count())
            <div class="section">
                <div class="section-title">اللغات</div>
                <ul>
                    @foreach($user->cvLanguages as $lang)
                        <li>{{ $lang->name }} - {{ $lang->proficiency }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($user->cvLinks?->count())
            <div class="section">
                <div class="section-title">روابط</div>
                <ul>
                    @foreach($user->cvLinks as $link)
                        <li><a href="{{ $link->url }}" target="_blank">{{ $link->label }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="right-col">
            @if($user->cvExperiences?->count())
            <div class="section">
                <div class="section-title">الخبرات</div>
                @foreach($user->cvExperiences as $exp)
                    <div class="entry">
                        <div class="entry-title">{{ $exp->company }}</div>
                        <div class="entry-subtitle">{{ $exp->position }}</div>
                        <div class="entry-date">{{ $exp->start_date }} - {{ $exp->end_date }}</div>
                        <div class="entry-desc">{{ $exp->description }}</div>
                    </div>
                @endforeach
            </div>
            @endif

            @if($user->cvEducations?->count())
            <div class="section">
                <div class="section-title">التعليم</div>
                @foreach($user->cvEducations as $edu)
                    <div class="entry">
                        <div class="entry-title">{{ $edu->institution }}</div>
                        <div class="entry-subtitle">{{ $edu->major }}</div>
                        <div class="entry-date">{{ $edu->graduation_date }}</div>
                    </div>
                @endforeach
            </div>
            @endif

            @if($user->cvProjects?->count())
            <div class="section">
                <div class="section-title">المشاريع</div>
                @foreach($user->cvProjects as $proj)
                    <div class="entry">
                        <div class="entry-title">{{ $proj->name }}</div>
                        <div class="entry-date">{{ $proj->completion_date }}</div>
                        <div class="entry-desc">{{ $proj->description }}</div>
                    </div>
                @endforeach
            </div>
            @endif

            @if($user->cvTrainings?->count())
            <div class="section">
                <div class="section-title">الدورات</div>
                @foreach($user->cvTrainings as $course)
                    <div class="entry">
                        <div class="entry-title">{{ $course->title }}</div>
                        <div class="entry-subtitle">{{ $course->provider }}</div>
                        <div class="entry-date">{{ $course->date }}</div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
