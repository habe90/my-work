<style>
    .company-card {
    margin: 20px;
    text-align: center;
}

.company-card img {
    width: 100%; /* Prilagodite širinu prema potrebi */
    height: auto;
    margin-bottom: 15px;
}

.company-card h4 {
    margin-bottom: 10px;
}

.company-card p {
    margin-bottom: 5px;
}
.company-card img {
    max-width: 50%; /* ili bilo koja druga vrijednost koja odgovara vašim potrebama */
    height: auto;
    margin-bottom: 15px;
}

/* Slick Slider navigacione strelice */
.slick-prev, .slick-next {
    display: none !important; /* Sakriva navigacione strelice */
}

/* Dodatno, ako želite sakriti tačke za navigaciju koje dolaze sa Slick Sliderom, koristite: */
.slick-dots {
    display: none !important;
}


</style>

<section class="light-w">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="sec-heading">
                    <h2>{{ __('global.featured_jobs') }} <span class="theme-cl-2">{{ __('global.featured_companies') }}</span></h2>
                    <p>{{ __('global.featured_jobs_description') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="slick-slider-container">
                    @foreach ($activeCompanies as $company)
                        <div class="company-card">
                            <a href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}">
                                <img src="{{ $company->logo }}" class="img-fluid" alt="{{ $company->company_name }}">
                            </a>
                            <h4>{{ $company->company_name }}</h4>
                            <p>{{ $company->offer_description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
    $('.slick-slider-container').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000, // Promijenite vrijednost za brzinu promjene između 3000 (3s) i 5000 (5s)
    });
});

</script>
