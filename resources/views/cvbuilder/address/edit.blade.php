@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">العنوان / مكان الإقامة</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cvbuilder.address.update') }}" method="POST">
        @csrf
        @method('PUT')

        @php
            $address = old('cv_address', $address->full_address ?? '');
        @endphp

        <div class="card p-3 mb-3">
            <div class="mb-3">
                <label>العنوان الكامل</label>
                <input type="text" name="cv_address" class="form-control" value="{{ $address }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection
