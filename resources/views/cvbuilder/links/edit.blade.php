@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">الروابط</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.links.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div id="links-list">
            @php
                $linkList = old('cv_links', $links ? $links->toArray() : []);
                $options = ['GitHub', 'LinkedIn', 'Twitter', 'Facebook', 'Portfolio', 'Behance', 'Dribbble', 'Other'];
            @endphp

            @foreach($linkList as $index => $link)
                <div class="card mb-3 p-3 link-item position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.link-item').remove()"></button>

                    <input type="hidden" name="cv_links[{{ $index }}][id]" value="{{ $link['id'] ?? '' }}">

                    <div class="mb-2">
                        <label>اسم الرابط</label>
                        <select name="cv_links[{{ $index }}][label]" class="form-control" required>
                            @foreach($options as $option)
                                <option value="{{ $option }}" @selected(($link['label'] ?? '') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>الرابط</label>
                        <input type="url" name="cv_links[{{ $index }}][url]" class="form-control" value="{{ $link['url'] ?? '' }}" required>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addLink()">+ إضافة رابط جديد</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let linkIndex = {{ count(old('cv_links', $links ?? [])) }};

    function addLink() {
        const container = document.getElementById('links-list');

        const html = `
            <div class="card mb-3 p-3 link-item position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.link-item').remove()"></button>

                <div class="mb-2">
                    <label>اسم الرابط</label>
                    <select name="cv_links[\${linkIndex}][label]" class="form-control" required>
                        <option value="GitHub">GitHub</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="Twitter">Twitter</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Portfolio">Portfolio</option>
                        <option value="Behance">Behance</option>
                        <option value="Dribbble">Dribbble</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>الرابط</label>
                    <input type="url" name="cv_links[\${linkIndex}][url]" class="form-control" required>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        linkIndex++;
    }
</script>
@endsection
