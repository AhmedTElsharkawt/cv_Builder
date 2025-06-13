@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">البيانات الشخصية</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.personal_info.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- الاسم (من جدول users) --}}
        <div class="mb-3">
            <label>الاسم</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control">
        </div>

        {{-- المسمى الوظيفي --}}
        <div class="mb-3">
            <label>المسمى الوظيفي</label>
            <input type="text" name="job_title" value="{{ old('job_title', $personalInfo->job_title ?? '') }}" class="form-control">
        </div>

        {{-- نبذة بسيطة --}}
        <div class="mb-3">
            <label>نبذة</label>
            <textarea name="bio" class="form-control">{{ old('bio', $personalInfo->bio ?? '') }}</textarea>
        </div>

        {{-- الصورة الشخصية --}}
        <div class="mb-3">
            <label>الصورة الشخصية</label>
            <input type="file" name="profile_image" class="form-control">
            @if(isset($personalInfo->profile_image))
                <img src="{{ asset("storage/$personalInfo->profile_image") }}" width="100" class="mt-2">
            @endif
        </div>

        {{-- الإيميل --}}
        <div class="mb-3">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control">
        </div>

        {{-- رقم الهاتف + كود الدولة --}}
        <div class="mb-3 row">
            <div class="col-md-4">
                <label>كود الدولة</label>
                <select name="phone_country_code" class="form-control">
                    <option value="+20">مصر (+20)</option>
                    <option value="+966">السعودية (+966)</option>
                    <!-- أضف أكواد دول حسب الحاجة -->
                </select>
            </div>

            <div class="col-md-8">
                <label>رقم الجوال</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        {{-- الجنس --}}
        <div class="mb-3">
            <label>الجنس</label>
            <select name="gender" class="form-control">
                <option value="">-- اختر --</option>
                <option value="male" {{ (old('gender', $personalInfo->gender ?? '') == 'male') ? 'selected' : '' }}>ذكر</option>
                <option value="female" {{ (old('gender', $personalInfo->gender ?? '') == 'female') ? 'selected' : '' }}>أنثى</option>
            </select>
        </div>

        {{-- الحالة الزوجية --}}
        <div class="mb-3">
            <label>الحالة الزوجية</label>
            <input type="text" name="marital_status" value="{{ old('marital_status', $personalInfo->marital_status ?? '') }}" class="form-control">
        </div>

        {{-- تاريخ الميلاد --}}
        <div class="mb-3">
            <label>تاريخ الميلاد</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', $personalInfo->birth_date ?? '') }}" class="form-control">
        </div>

        {{-- الموقع الشخصي --}}
        <div class="mb-3">
            <label>الموقع الشخصي</label>
            <input type="url" name="website" value="{{ old('website', $personalInfo->website ?? '') }}" class="form-control">
        </div>

        {{-- الدولة --}}
        <div class="mb-3">
            <label>الدولة</label>
            <input type="text" name="country" value="{{ old('country', $personalInfo->country ?? '') }}" class="form-control">
        </div>

        {{-- الجنسية --}}
        <div class="mb-3">
            <label>الجنسية</label>
            <input type="text" name="nationality" value="{{ old('nationality', $personalInfo->nationality ?? '') }}" class="form-control">
        </div>

        {{-- الحالة الصحية --}}
        <div class="mb-3">
            <label>الحالة الصحية</label>
            <select name="health_status" class="form-control">
                <option value="">-- اختر --</option>
                <option value="healthy" {{ old('health_status', $personalInfo->health_status ?? '') == 'healthy' ? 'selected' : '' }}>سليم</option>
                <option value="has_condition" {{ old('health_status', $personalInfo->health_status ?? '') == 'has_condition' ? 'selected' : '' }}>لدي حالة</option>
            </select>
        </div>
        {{-- الخدمة العسكرية --}}
        <div class="mb-3">
            <label>الخدمة العسكرية</label>
            <select name="military_status" class="form-control">
                <option value="">-- اختر --</option>
                <option value="completed" {{ old('military_status', $personalInfo->military_status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="serving" {{ old('military_status', $personalInfo->military_status ?? '') == 'serving' ? 'selected' : '' }}>Serving</option>
                <option value="exempt" {{ old('military_status', $personalInfo->military_status ?? '') == 'exempt' ? 'selected' : '' }}>Exempt</option>
            </select>
        </div>

        {{-- زر الحفظ --}}
        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
    </form>
</div>
@endsection
