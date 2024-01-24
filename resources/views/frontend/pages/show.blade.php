@extends('frontend.layouts.front')

@section('content')
<!-- ============================ Page Title Start================================== -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <!-- Ovdje ispisujete naslov stranice koristeći $contentPage varijablu -->
                <h2 class="ipt-title">{{ $contentPage->title }}</h2>
                <!-- Ako imate i podnaslov, možete ga ovdje dodati -->
                {{-- <span class="ipn-subtitle">{{ $contentPage->subtitle ?? 'Podnaslov nije definisan' }}</span> --}}
                
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- Ovdje započinje vaš postojeći HTML -->
<section class="gray-light min-sec">
    <div class="container">
        
        <!-- Ovdje ispisujete sadržaj stranice -->
        {!! $contentPage->page_text !!}

    </div>
</section>
<!-- Ovdje završava vaš postojeći HTML -->

@endsection
