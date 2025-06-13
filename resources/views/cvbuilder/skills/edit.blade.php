@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">المهارات</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.skills.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div id="skills-list">
            @php $skillList = old('cv_skills', $skills ? $skills->toArray() : []); @endphp

            @foreach($skillList as $index => $skill)
                <div class="card mb-3 p-3 skill-item position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.skill-item').remove()"></button>

                    <input type="hidden" name="cv_skills[{{ $index }}][id]" value="{{ $skill['id'] ?? '' }}">

                    <div class="mb-2">
                        <label>اسم المهارة</label>
                        <input type="text" name="cv_skills[{{ $index }}][name]" class="form-control" value="{{ $skill['name'] ?? '' }}" required>
                    </div>

                    <div class="mb-2">
                        <label>مستوى المهارة</label>
                        <select name="cv_skills[{{ $index }}][level]" class="form-control" required>
                            @foreach(['beginner', 'intermediate', 'advanced', 'expert'] as $level)
                                <option value="{{ $level }}" @selected(($skill['level'] ?? '') === $level)>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addSkill()">+ إضافة مهارة جديدة</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let skillIndex = {{ count(old('cv_skills', $skills ?? [])) }};

    function addSkill() {
        const container = document.getElementById('skills-list');

        const html = `
            <div class="card mb-3 p-3 skill-item position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.skill-item').remove()"></button>

                <div class="mb-2">
                    <label>اسم المهارة</label>
                    <input type="text" name="cv_skills[\${skillIndex}][name]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>مستوى المهارة</label>
                    <select name="cv_skills[\${skillIndex}][level]" class="form-control" required>
                        <option value="beginner">beginner</option>
                        <option value="intermediate">intermediate</option>
                        <option value="advanced">advanced</option>
                        <option value="expert">expert</option>
                    </select>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        skillIndex++;
    }
</script>
@endsection
