@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">الدورات التدريبية</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.trainings.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div id="trainings-list">
            @php $trainingList = old('cv_trainings', $trainings ? $trainings->toArray() : []); @endphp

            @foreach($trainingList as $index => $training)
                <div class="card mb-3 p-3 training-item">
                    <div class="mb-2">
                        <label>اسم الدورة</label>
                        <input type="text" name="cv_trainings[{{ $index }}][title]" class="form-control" value="{{ $training['title'] ?? '' }}" required>
                    </div>
                    <div class="mb-2">
                        <label>الجهة المقدمة</label>
                        <input type="text" name="cv_trainings[{{ $index }}][provider]" class="form-control" value="{{ $training['provider'] ?? '' }}" required>
                    </div>
                    <div class="mb-2">
                        <label>تاريخ الحصول</label>
                        <input type="date" name="cv_trainings[{{ $index }}][end_date]" class="form-control" value="{{ $training['end_date'] ?? '' }}">
                    </div>
                    @error('cv_trainings.*.end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-2">
                        <label>الوصف</label>
                        <textarea name="cv_trainings[{{ $index }}][description]" class="form-control">{{ $training['description'] ?? '' }}</textarea>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-training">حذف</button>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addTraining()">+ إضافة دورة</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let trainingIndex = {{ count(old('cv_trainings', $trainings ?? [])) }};

    function addTraining() {
        const container = document.getElementById('trainings-list');
        const html = `
            <div class="card mb-3 p-3 training-item">
                <div class="mb-2">
                    <label>اسم الدورة</label>
                    <input type="text" name="cv_trainings[\${index}][title]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>الجهة المقدمة</label>
                    <input type="text" name="cv_trainings[\${index}][provider]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>تاريخ الحصول</label>
                    <input type="date" name="cv_trainings[\${index}][end_date]" class="form-control">
                </div>
                <div class="mb-2">
                    <label>الوصف</label>
                    <textarea name="cv_trainings[\${index}][description]" class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-training">حذف</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        trainingIndex++;
    }

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-training')) {
            e.target.closest('.training-item').remove();
        }
    });
</script>
@endsection
