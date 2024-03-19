{{-- resources/views/errors/403.blade.php --}}
@extends('frontend.layouts.front')

@section('title', 'Zugriff verweigert')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold" style="font-size: 6rem;">403</h1>
            <p class="fs-1"> <span class="text-danger">Hoppla!</span> Zugriff verweigert.</p>
            <p class="fs-3">
                Sie sind nicht berechtigt, diese Seite zu sehen.
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Zur Startseite</a>
        </div>
    </div>
</div>
@endsection
