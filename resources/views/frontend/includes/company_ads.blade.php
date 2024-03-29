<style>
.company-card {
    display: flex;
    align-items: center; /* centriranje sadržaja po vertikali */
    border: 1px solid #eee;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    transition: box-shadow 0.3s ease-in-out;
    padding: 20px; /* Dodatni prostor unutar kartice */
}

.company-logo img {
    width: auto; /* Da bi slika zadržala originalne proporcije */
    max-width: 120px; /* Maksimalna širina slike */
    height: auto;
    margin-right: 20px; /* Dodatni prostor između slike i teksta */
}

.company-info {
    flex: 1; /* Zauzima preostali prostor u flex kontejneru */
}

/* Stilovi za tekst i druge elemente se mogu zadržati isti kao u prethodnim koracima */


.company-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.2); /* jači sjenčani efekt prilikom hovera */
}

.company-card img {
    max-width: 100%; /* slika se prilagođava širini kartice */
    height: 180px; /* visina se automatski prilagođava */
}

.company-card h4 {
    color: #333; /* tamnija boja teksta za naslov */
    font-size: 18px; /* veličina fonta za naslov */
    margin: 10px 0; /* razmak iznad i ispod naslova */
}

.company-card p {
    color: #666; /* svjetlija boja teksta za opis */
    font-size: 14px; /* veličina fonta za opis */
    margin-bottom: 15px; /* razmak ispod opisa */
}

/* Stilovi za datum i ostale informacije kao što su lokacija i tip posla */
/* Prethodno definisani stilovi... */

/* Dodatni stilovi za nove elemente */
.date-location, .job-type, .applications-info {
    display: block; /* elementi će biti prikazani kao blok */
    margin: 5px 0; /* malo prostora iznad i ispod svakog elementa */
}

.date-location {
    color: #999; /* svjetlija siva za datum i lokaciju */
    font-size: 12px; /* manji font za datum i lokaciju */
}

.job-type {
    display: inline-block; /* tip posla kao inline element sa blok osobinama */
    background-color: #5cb85c; /* zelena pozadina za tip posla */
    color: white; /* bijeli tekst za tip posla */
    padding: 3px 7px; /* unutarnji prostor oko teksta */
    border-radius: 4px; /* blago zaobljeni uglovi */
    font-size: 12px; /* mali font za tip posla */
    margin: 5px 0; /* prostor iznad i ispod */
}

.applications-info {
    color: #999; /* svjetlija siva za broj aplikacija */
    font-size: 12px; /* manji font za broj aplikacija */
    margin-bottom: 10px; /* veći prostor na dnu elementa */
}

.slick-prev, .slick-next {
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
                        <div class="company-card d-flex">
                            <div class="company-logo">
                                <a href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}">
                                    <img src="{{ $company->logo }}" alt="{{ $company->company_name }}">
                                </a>
                            </div>
                            <div class="company-info">
                                <div class="date-location">{{ $company->address }}</div>
                                <h4> <a href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}">{{ $company->company_name }} </a></h4>
                                <div class="job-type">VIP</div>
                                <p>{!! $company->offer_description !!}</p>
                                {{-- <div class="applications-info">17+ People Applied</div> --}}
                            </div>
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
