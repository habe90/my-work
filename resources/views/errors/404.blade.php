
@extends('frontend.layouts.front')

@section('title', 'Seite nicht gefunden')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold" style="font-size: 6rem;">404</h1>
            <p class="fs-1"> <span class="text-danger">Hoppla!</span> Seite nicht gefunden.</p>
            <p class="fs-3">
                Die Seite, nach der Sie suchen, existiert nicht.
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Zur Startseite</a>
        </div>
    </div>
</div>
@endsection
