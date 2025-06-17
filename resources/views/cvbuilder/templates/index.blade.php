@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">اختر قالب السيرة الذاتية</h2>

    <div class="row">
        @foreach($templates as $template)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($template->preview_image) }}" class="card-img-top" alt="Preview">
                    <div class="card-body text-center">
                        <a href="{{ route('cvbuilder.templates.show', $template->name) }}" class="btn btn-primary">معاينة القالب</a>
                        <a href="{{ route('cvbuilder.templates.download', $template->name) }}" class="btn btn-primary">تحميل القالب</a>
                        @if ($template->type === 'paid' && !auth()->user()->cv_hasPurchasedTemplate($template->id))
                        <a href="{{ route('cvbuilder.templates.purchase', $template->id) }}" class="btn btn-primary">شراء القالب</a>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
