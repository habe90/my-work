@extends('frontend.layouts.front')
@section('content')
    <!-- ============================ Page Title Start================================== -->
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
    <!-- ============================ Page Title End ================================== -->

    <!-- Ovdje započinje vaš postojeći HTML -->
    <section class="gray-light min-sec">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row form-submit">

                <!-- Livewire formular za renovaciju -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <h1>{{ __('messages.upload_required_documents', [], app()->getLocale()) }}</h1>
                    @livewire('company-verification')

                </div>

            </div>
        </div>
    </section>


@endsection
