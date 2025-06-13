@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">الأعمال / المشاريع</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.projects.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div id="projects-list">
            @php $projectList = old('cv_projects', $projects ? $projects->toArray() : []); @endphp

            @foreach($projectList as $index => $project)
                <div class="card mb-3 p-3 project-item position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.project-item').remove()"></button>

                    <input type="hidden" name="cv_projects[{{ $index }}][id]" value="{{ $project['id'] ?? '' }}">

                    <div class="mb-2">
                        <label>اسم المشروع</label>
                        <input type="text" name="cv_projects[{{ $index }}][name]" class="form-control" value="{{ $project['name'] ?? '' }}" required>
                    </div>

                    <div class="mb-2">
                        <label>رابط المشروع (اختياري)</label>
                        <input type="url" name="cv_projects[{{ $index }}][url]" class="form-control" value="{{ $project['url'] ?? '' }}">
                    </div>

                    <div class="mb-2">
                        <label>تاريخ الإنجاز</label>
                        <input type="date" name="cv_projects[{{ $index }}][completion_date]" class="form-control" value="{{ $project['completion_date'] ?? '' }}">
                    </div>

                    <div class="mb-2">
                        <label>الوصف</label>
                        <textarea name="cv_projects[{{ $index }}][description]" class="form-control">{{ $project['description'] ?? '' }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addProject()">+ إضافة مشروع</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let projectIndex = {{ count(old('cv_projects', $projects ?? [])) }};

    function addProject() {
        const container = document.getElementById('projects-list');

        const html = `
            <div class="card mb-3 p-3 project-item position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.project-item').remove()"></button>

                <div class="mb-2">
                    <label>اسم المشروع</label>
                    <input type="text" name="cv_projects[\${projectIndex}][name]" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>رابط المشروع (اختياري)</label>
                    <input type="url" name="cv_projects[\${projectIndex}][url]" class="form-control">
                </div>

                <div class="mb-2">
                    <label>تاريخ الإنجاز</label>
                    <input type="date" name="cv_projects[\${projectIndex}][completion_date]" class="form-control">
                </div>

                <div class="mb-2">
                    <label>الوصف</label>
                    <textarea name="cv_projects[\${projectIndex}][description]" class="form-control"></textarea>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        projectIndex++;
    }
</script>
@endsection
