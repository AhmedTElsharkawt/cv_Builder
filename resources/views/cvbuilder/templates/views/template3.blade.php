@extends('layouts.app')

@section('content')
<style>
    /* Styles for CV template matching provided design */
    .cv-page {
        max-width: 800px;
        margin: 2rem auto;
        font-family: Arial, sans-serif;
        color: #000;
        background: #fff;
        padding: 1.5rem;
    }
    .header {
        display: flex;
        align-items: center;
        position: relative;
        margin-bottom: 1.5rem;
    }
    .header-bg {
        background: #f0f0f0;
        border-radius: 8px;
        padding: 1rem 1.5rem;
        flex: 1;
        margin-left: 80px;
    }
    .profile-img-wrapper {
        position: absolute;
        left: 0;
        top: 0;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #fff;
        background: #fff;
    }
    .profile-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .header-text {
        margin-left: 100px;
    }
    .header-text h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: bold;
    }
    .header-text p.contact-info {
        margin: 0.25rem 0;
        font-size: 0.9rem;
        color: #555;
    }
    .section {
        margin-bottom: 1.5rem;
    }
    .section-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        border-bottom: 1px solid #ccc;
        padding-bottom: 0.25rem;
    }
    .two-columns {
        display: flex;
        gap: 1.5rem;
    }
    .left-col, .right-col {
        flex: 1;
    }
    .entry {
        margin-bottom: 1rem;
    }
    .entry-title {
        font-weight: bold;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }
    .entry-subtitle {
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.25rem;
    }
    .entry-date {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 0.25rem;
    }
    .entry-desc {
        font-size: 0.9rem;
        color: #000;
        margin-left: 1rem;
    }
    ul.list-items {
        list-style: disc;
        padding-left: 1.2rem;
    }
</style>

<div class="cv-page">
    <!-- Header with profile image and name/title/contact -->
    <div class="header">
        <div class="profile-img-wrapper">
            @if($user->cvPersonalInfo?->profile_image)
                <img src="{{ asset('storage/' . $user->cvPersonalInfo->profile_image) }}" alt="Profile">
            @endif
        </div>
        <div class="header-bg">
            <div class="header-text">
                <h1>{{ $user->name }}</h1>
                @if($user->cvPersonalInfo?->job_title)
                    <p class="contact-info">{{ $user->cvPersonalInfo->job_title }}</p>
                @endif
                <p class="contact-info">
                    @if($user->phone_number) +{{ $user->phone_number }} @endif
                    @if($user->email) | {{ $user->email }} @endif
                    @if($user->cvAddress?->full_address) | {{ $user->cvAddress->full_address }} @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Professional Summary -->
    @if($user->cvPersonalInfo?->bio)
    <div class="section">
        <div class="section-title">Professional Summary</div>
        <p>{{ $user->cvPersonalInfo->bio }}</p>
    </div>
    @endif

    <div class="two-columns">
        <!-- Left Column: Skills and Education -->
        <div class="left-col">
            @if($user->cvSkills?->count())
            <div class="section">
                <div class="section-title">Skills</div>
                <ul class="list-items">
                    @foreach($user->cvSkills as $skill)
                        <li>{{ $skill->name }} - {{ $skill->level }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($user->cvEducations?->count())
            <div class="section">
                <div class="section-title">Education</div>
                @foreach($user->cvEducations as $edu)
                <div class="entry">
                    <div class="entry-title">{{ $edu->institution }} | {{ $edu->graduation_date }}</div>
                    @if($edu->major)
                    <div class="entry-subtitle">{{ $edu->major }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right Column: Experience -->
        <div class="right-col">
            @if($user->cvExperiences?->count())
            <div class="section">
                <div class="section-title">Experience</div>
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
        </div>
    </div>
</div>
@endsection
