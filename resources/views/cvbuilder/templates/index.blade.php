@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">اختر قالب السيرة الذاتية</h2>

    <div class="row">
        @foreach(['template1', 'template2', 'template3'] as $template)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset("images/templates/$template.png") }}" class="card-img-top" alt="Preview">
                    <div class="card-body text-center">
                        <a href="{{ route('cvbuilder.templates.show', $template) }}" class="btn btn-primary">معاينة القالب</a>
                        <a href="{{ route('cvbuilder.templates.download', $template) }}" class="btn btn-primary">تحميل القالب</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
