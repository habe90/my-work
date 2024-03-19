{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')

@section('title', 'Stranica nije pronađena')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
          </p>
        <a href="{{ route('/')}}" class="btn btn-primary">Go Home</a>
    </div>
</div>
@endsection
