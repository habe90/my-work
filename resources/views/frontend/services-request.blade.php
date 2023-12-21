@extends('frontend.layouts.front')
@section('content')
<!-- ============================ Page Title Start================================== -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title">Checkout Page</h2>
                <span class="ipn-subtitle">Billing & Payment Page</span>
                
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- Ovdje započinje vaš postojeći HTML -->
<section class="gray-light min-sec">
    <div class="container">
        <div class="row form-submit">
            <!-- ... Ostali HTML elementi ... -->

            <!-- Livewire formular za renovaciju -->
            <div class="col-lg-8 col-md-12 col-sm-12">
                @livewire('choose-form', ['categoryId' => $categoryId])
            </div>

            <!-- ... Ostali HTML elementi ... -->
        </div>
    </div>
</section>
<!-- Ovdje završava vaš postojeći HTML -->

@endsection