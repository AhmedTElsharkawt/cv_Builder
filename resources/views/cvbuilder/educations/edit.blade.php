@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">المؤهلات العلمية</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.educations.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div id="educations-list">
            @foreach(old('educations', $educations->toArray()) as $index => $education)
                <div class="card mb-3 p-3 education-item">
                    <input type="hidden" name="cv_educations[{{ $index }}][id]" value="{{ $education['id'] ?? '' }}">

                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label>الجهة التعليمية</label>
                            <input type="text" name="cv_educations[{{ $index }}][institution]" class="form-control" value="{{ $education['institution'] ?? '' }}" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>التخصص</label>
                            <input type="text" name="cv_educations[{{ $index }}][major]" class="form-control" value="{{ $education['major'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label>الدرجة العلمية</label>
                            <select name="cv_educations[{{ $index }}][degree]" class="form-control">
                                <option value="">اختر</option>
                                <option value="high_school" {{ ($education['degree'] ?? '') == 'high_school' ? 'selected' : '' }}>ثانوية</option>
                                <option value="diploma" {{ ($education['degree'] ?? '') == 'diploma' ? 'selected' : '' }}>دبلوم</option>
                                <option value="bachelor" {{ ($education['degree'] ?? '') == 'bachelor' ? 'selected' : '' }}>بكالوريوس</option>
                                <option value="master" {{ ($education['degree'] ?? '') == 'master' ? 'selected' : '' }}>ماجستير</option>
                                <option value="doctorate" {{ ($education['degree'] ?? '') == 'doctorate' ? 'selected' : '' }}>دكتوراه</option>
                                <option value="other" {{ ($education['degree'] ?? '') == 'other' ? 'selected' : '' }}>أخرى</option>

                            </select>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>تاريخ التخرج</label>
                            <input type="date" name="cv_educations[{{ $index }}][graduation_date]" class="form-control" value="{{ $education['graduation_date'] ?? '' }}">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>وصف بسيط</label>
                        <textarea name="cv_educations[{{ $index }}][description]" class="form-control">{{ $education['description'] ?? '' }}</textarea>
                    </div>

                    <button type="button" class="btn btn-danger remove-education">حذف</button>

                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addEducation()">+ إضافة مؤهل جديد</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let educationIndex = {{ count(old('educations', $educations)) }};

    function addEducation() {
        const container = document.getElementById('educations-list');

        const html = `
            <div class="card mb-3 p-3 education-item">
                <div class="row">
                    <div class="mb-2 col-md-6">
                        <label>الجهة التعليمية</label>
                        <input type="text" name="cv_educations[\${educationIndex}][institution]" class="form-control" required>
                    </div>

                    <div class="mb-2 col-md-6">
                        <label>التخصص</label>
                        <input type="text" name="cv_educations[\${educationIndex}][major]" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-2 col-md-6">
                        <label>الدرجة العلمية</label>
                        <select name="cv_educations[\${educationIndex}][degree]" class="form-control">
                            <option value="">اختر</option>
                            <option value="high_school">ثانوية</option>
                            <option value="diploma">دبلوم</option>
                            <option value="bachelor">بكالوريوس</option>
                            <option value="master">ماجستير</option>
                            <option value="other">دكتوراه</option>
                        </select>
                    </div>

                    <div class="mb-2 col-md-6">
                        <label>تاريخ التخرج</label>
                        <input type="date" name="cv_educations[\${educationIndex}][graduation_date]" class="form-control">
                    </div>
                </div>

                <div class="mb-2">
                    <label>وصف بسيط</label>
                    <textarea name="cv_educations[\${educationIndex}][description]" class="form-control"></textarea>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        educationIndex++;
    }

    // حذف البلوك عند الضغط على زر الحذف
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-education')) {
            e.target.closest('.education-item').remove();
        }
    });
</script>
@endsection
