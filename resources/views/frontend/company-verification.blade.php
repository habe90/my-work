@extends('frontend.layouts.front')
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">Postdienste</h2>
                    <span class="ipn-subtitle">Dienstleistungsanfrage</span>
                </div>
            </div>
        </div>
    </div>

    <section class="gray-light min-sec">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    @livewire('company-verification')
                </div>
            </div>
        </div>
    </section>
@endsection
