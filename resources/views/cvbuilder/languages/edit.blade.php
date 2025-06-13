@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">اللغات</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.languages.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div id="languages-list">
            @php $languageList = old('cv_languages', $languages ? $languages->toArray() : []); @endphp

            @foreach($languageList as $index => $language)
                <div class="card mb-3 p-3 language-item position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.language-item').remove()"></button>

                    <input type="hidden" name="cv_languages[{{ $index }}][id]" value="{{ $language['id'] ?? '' }}">

                    <div class="mb-2">
                        <label>اللغة</label>
                        <select name="cv_languages[{{ $index }}][name]" class="form-control" required>
                            @php
                                $availableLanguages = ['Arabic', 'English', 'French', 'German', 'Spanish', 'Chinese', 'Japanese', 'Russian', 'Italian', 'Turkish'];
                            @endphp

                            @foreach ($availableLanguages as $lang)
                                <option value="{{ $lang }}" @selected(($language['name'] ?? '') === $lang)>{{ $lang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>مستوى الإتقان</label>
                        <select name="cv_languages[{{ $index }}][proficiency]" class="form-control" required>
                            @foreach(['beginner', 'intermediate', 'advanced', 'fluent', 'native'] as $level)
                                <option value="{{ $level }}" @selected(($language['proficiency'] ?? '') === $level)>
                                    {{ $level }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addLanguage()">+ إضافة لغة</button>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    let languageIndex = {{ count(old('cv_languages', $languages ?? [])) }};

    function addLanguage() {
        const container = document.getElementById('languages-list');

        const html = `
            <div class="card mb-3 p-3 language-item position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.closest('.language-item').remove()"></button>

                <div class="mb-2">
                    <label>اللغة</label>
                    <select name="cv_languages[\${languageIndex}][name]" class="form-control" required>
                        <option value="Arabic">Arabic</option>
                        <option value="English">English</option>
                        <option value="French">French</option>
                        <option value="German">German</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Russian">Russian</option>
                        <option value="Italian">Italian</option>
                        <option value="Turkish">Turkish</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label>المستوى</label>
                    <select name="cv_languages[\${languageIndex}][proficiency]" class="form-control" required>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                        <option value="fluent">Fluent</option>
                        <option value="native">Native</option>
                    </select>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        languageIndex++;
    }
</script>
@endsection
