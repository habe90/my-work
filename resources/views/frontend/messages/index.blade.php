
@extends('frontend.layouts.front')
@section('content')
<style>
    .chat-content {
    max-height: 500px; /* Ovo postavlja maksimalnu visinu za chat */
    overflow-y: auto; /* Ovo omogućava vertikalni skrol unutar diva */
}
</style>
<!-- ============================ Page Title Start================================== -->
<div class="page-title bg-cover" style="background:url(https://via.placeholder.com/1920x980)no-repeat;" data-overlay="5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12"></div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->
<section class="gray-bg pt-4">
    <div class="container-fluid">
        <div class="row m-0">
            
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                @include('frontend.includes.sidebar')
            </div>
            
            <!-- Item Wrap Start -->
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Breadcrumbs -->
                        <div class="bredcrumb_wrap">
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Messages</li>
                              </ol>
                            </nav>	
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    @livewire('messages-component')
                </div>
                
            </div>
            
        </div>
    </div>
</section>

@endsection