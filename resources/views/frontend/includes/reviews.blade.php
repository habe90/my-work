<!-- ============================ Featured Themes Start ==================================== -->
<section class="light-w">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="sec-heading">
                    <h2>{{ __('front.what_people_say') }}</h2>
                    <p>{{ __('front.customer_experiences') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="owl-carousel owl-theme middle-arrow-hover" id="theme-slide">
                    @foreach ($reviews as $review)
                    <!-- Single Review -->
                    <div class="item">
                        <div class="smart-testimonials">
                            <div class="smart-testi-thumb">
                                <img src="{{ $review->image }}" class="img-fluid" alt="" />
                                <span class="cipt bg-success"><i class="fa fa-quote-left"></i></span>
                            </div>
                            <div class="smart-testimonials-content">
                                <div class="smart-tes-content">
                                    <p>{{ $review->description }}</p>
                                </div>
                                <div class="st-author-info">
                                    <h4 class="st-author-title">{{ $review->name }}</h4>
                                    <span class="st-author-subtitle theme-cl">{{ $review->position }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

</section>
<!-- ============================ Featured Themes End ==================================== -->
