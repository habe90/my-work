@extends('frontend.layouts.front')
@section('content')
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

                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ Breadcrumbs::render('user-reviews') }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                            <!-- Single Wrap -->
                            <div class="_dashboard_content">
                                <div class="_dashboard_content_header">
                                    <div class="_dashboard__header_flex">
                                        <h4><i class="fa fa-star mr-1"></i>Rezensionen</h4>	
                                    </div>
                                </div>
                                
                                <div class="_dashboard_content_body p-0">
                                    <div class="_grouping_reviews_wrap">
                                        @forelse ($ratings as $rating)
                                            <!-- Single Reviews -->
                                            <div class="_grouping_single_reviews">
                                                <div class="_grouping_single_reviews_thumb">
                                                    <!-- Ovdje možete dodati sliku korisnika ili nešto slično -->
                                                    <img src="{{ $rating->user->profile_image ?? 'https://via.placeholder.com/500x500' }}" class="img-fluid circle" alt="{{ $rating->user->name ?? 'Nepoznati korisnik' }}" />
                                                </div>
                                                <div class="_grouping_single_reviews_caption">
                                                    <h4 class="_rev_title_cats">{{ $rating->user->name }}<span class="esxlop_titme">{{ $rating->created_at->diffForHumans() }}</span></h4>
                                                    <div class="_dash_usr_rates mb-1">
                                                        <span class="good">{{ $rating->rating }}</span>
                                                        <!-- Ovdje možete dodati logiku za prikaz zvjezdica na osnovu ocjene -->
                                                        @for ($i = 0; $i < $rating->rating; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <h5 class="_rev_subject_cats">Kommentar:</h5>
                                                    <p>{{ $rating->comment }}</p>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="_grouping_single_reviews text-center">
                                                <p>Keine Bewertungen verfügbar.</p>
                                            </div>
                                            @endforelse
                                        {{ $ratings->links() }}
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Single Wrap End -->
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')

@endpush

