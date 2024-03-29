<style>
    .full-width-sponsored .container-fluid {
        max-width: 100%;
        padding-right: 0;
        padding-left: 0;
    }

    .full-width-carousel .item {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .company-card {
        text-align: center;
        padding: 20px;
    }

    .company-logo {
        max-width: 100%;
        height: auto;
    }

    .company-name {
        margin-top: 20px;
        font-size: 24px;
    }

    .company-description {
        font-size: 16px;
        margin-top: 10px;
    }
</style>
<section class="light-w full-width-sponsored">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="sec-heading center">
                    <h2>{{ __('global.featured_jobs') }} <span
                            class="theme-cl-2">{{ __('global.featured_companies') }}</span></h2>
                    <p>{{ __('global.featured_jobs_description') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel owl-theme full-width-carousel" id="featured-companies-slider">
                    @foreach ($activeCompanies as $company)
                        <div class="item">
                            <div class="company-card">
                                <a
                                    href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}">
                                    <img src="{{ $company->logo }}" class="img-fluid company-logo"
                                        alt="{{ $company->company_name }}">
                                </a>
                                <h4 class="company-name">{{ $company->company_name }}</h4>
                                <p class="company-description">{{ $company->offer_description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
    $("#featured-companies-slider").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000, // Promijenite vrijednost za brzinu promjene između 3000 (3s) i 5000 (5s)
        autoplayHoverPause: true
    });
});

</script>
