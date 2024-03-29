<style>
.company-card {
    margin: 20px auto; /* centriraj karticu sa automatskim marginama */
    text-align: center;
    border: 1px solid #eee; /* svijetla boja za granicu */
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* blagi sjenčani efekt */
    border-radius: 8px; /* zaobljeni uglovi */
    overflow: hidden; /* spriječava elemente da prelaze granice kartice */
    background: #fff; /* bijela pozadina */
    transition: box-shadow 0.3s ease-in-out; /* animacija sjenke */
}

.company-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.2); /* jači sjenčani efekt prilikom hovera */
}

.company-card img {
    max-width: 100%; /* slika se prilagođava širini kartice */
    height: auto; /* visina se automatski prilagođava */
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




</style>

<section class="light-w">
    <div class="container">
        <div class="row justify-content-right">
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
                            <div class="date-location">24/8/2021 | USA, San Francisco</div> <!-- Dodani datum i lokacija -->
                            <h4>{{ $company->company_name }}</h4>
                            <div class="job-type">Full Time</div> <!-- Dodani tip posla -->
                            <p>{{ $company->offer_description }}</p>
                            <div class="applications-info">17+ People Applied</div> <!-- Dodani broj aplikacija -->
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
