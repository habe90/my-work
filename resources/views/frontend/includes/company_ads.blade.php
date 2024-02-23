<!-- ============================ Featured Themes Start ==================================== -->
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
                <div class="owl-carousel owl-theme middle-arrow-hover" id="theme-slide">
                
                
                    
                    <!-- Foreach ads here -->
                    @foreach($activeCompanies as $company)
                    <div class="themes-slides">
                        <div class="_jb_list73">
                            <div class="_jb_list73_header">
                                <!-- Ostatak koda ... -->
                                <div class="_jb_list72_flex">
                                    <div class="_jb_list72_first">
                                        <div class="_jb_list72_yhumb small-thumb">
                                          <a href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}"><img src="{{ $company->logo }}" class="img-fluid" alt="{{ $company->company_name }}"></a>
                                        </div>
                                    </div>
                                    <div class="_jb_list72_last">
                                        <h4 class="_jb_title"><a href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}">{{ $company->company_name }}</a></h4>
                                      
                                    </div>
                                </div>
                                <!-- Ostatak koda ... -->
                            </div>
                            <div class="_jb_list73_middle">
                                <!-- Ostatak koda ... -->
                                <div class="_jb_list73_middle_flex">
                                    <h4 class="_jb_title"><a href="{{ Str::startsWith($company->link, ['http://', 'https://']) ? $company->link : 'http://' . $company->link }}">Visit company</a></h4>
                                    <!-- Ostatak koda ... -->
                                </div>
                                <!-- Ostatak koda ... -->
                            </div>
                            <div class="_jb_list73_footer">
                                <!-- Ostatak koda ... -->
                                <div class="opis_firme">{{ $company->offer_description }}</div>
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