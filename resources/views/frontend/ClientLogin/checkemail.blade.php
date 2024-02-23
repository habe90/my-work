@extends('frontend.layouts.front')
@section('content')
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <h2 class="ipt-title">Post Services</h2>
                    <span class="ipn-subtitle">Services Request</span>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- Ovdje započinje vaš postojeći HTML -->
    <section class="gray-light min-sec">
        <div class="container">
            <div class="row justify-content-center">
          

                <!-- Livewire formular za renovaciju -->
                <div class="col-lg-6 col-md-8">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                @endif
                    <div class="login-form bg-white p-4 border rounded">
                        <h4>Erhalten Sie Anfragen von Bauunternehmen in Ihrer Nähe.</h4>
                        <p>Ihre Daten sind für Handwerker erst sichtbar, wenn Sie sie kontaktieren.</p>
                        @livewire('check-email-form')
                </div>
            </div>
        </div>
    </section>

@endsection

   