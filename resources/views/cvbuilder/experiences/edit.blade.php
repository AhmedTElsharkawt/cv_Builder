@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">الخبرات العملية</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.experiences.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div id="experiences-list">
            @php $experienceList = old('cv_experiences', $experiences ? $experiences->toArray() : []); @endphp

            @foreach($experienceList as $index => $experience)
                <div class="card mb-3 p-3 experience-item">
                    <input type="hidden" name="cv_experiences[{{ $index }}][id]" value="{{ $experience['id'] ?? '' }}">

                    <div class="mb-2">
                        <label>جهة العمل</label>
                        <input type="text" name="cv_experiences[{{ $index }}][company]" class="form-control" value="{{ $experience['company'] ?? '' }}" required>
                    </div>

                    <div class="mb-2">
                        <label>المسمى الوظيفي</label>
                        <input type="text" name="cv_experiences[{{ $index }}][position]" class="form-control" value="{{ $experience['position'] ?? '' }}">
                    </div>

                    <div class="mb-2">
                        <label>تاريخ الالتحاق</label>
                        <input type="date" name="cv_experiences[{{ $index }}][start_date]" class="form-control" value="{{ $experience['start_date'] ?? '' }}">
                    </div>

                    <div class="mb-2">
                        <label>تاريخ المغادرة</label>
                        <input type="date" name="cv_experiences[{{ $index }}][end_date]" class="form-control" value="{{ $experience['end_date'] ?? '' }}">
                    </div>

                    @error('cv_experiences.*.end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-2">
                        <label>وصف بسيط</label>
                        <textarea name="cv_experiences[{{ $index }}][description]" class="form-control">{{ $experience['description'] ?? '' }}</textarea>
                    </div>

                    <button type="button" class="btn btn-danger remove-experience">حذف</button>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addExperience()">+ إضافة خبرة جديدة</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let experienceIndex = {{ count(old('cv_experiences', $experiences)) }};

    function addExperience() {
        const container = document.getElementById('experiences-list');

        const html = `
            <div class="card mb-3 p-3 experience-item">
                <div class="mb-2">
                    <label>جهة العمل</label>
                    <input type="text" name="cv_experiences[${experienceIndex}][company]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>المسمى الوظيفي</label>
                    <input type="text" name="cv_experiences[${experienceIndex}][position]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>تاريخ الالتحاق</label>
                    <input type="date" name="cv_experiences[${experienceIndex}][start_date]" class="form-control">
                </div>

                <div class="mb-2">
                    <label>تاريخ المغادرة</label>
                    <input type="date" name="cv_experiences[${experienceIndex}][end_date]" class="form-control">
                </div>

                <div class="mb-2">
                    <label>وصف بسيط</label>
                    <textarea name="cv_experiences[${experienceIndex}][description]" class="form-control"></textarea>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        experienceIndex++;
    }

    // حذف البلوك عند الضغط على زر الحذف
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-experience')) {
            e.target.closest('.experience-item').remove();
        }
    });
    </script>

@endsection
