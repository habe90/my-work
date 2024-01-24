<!-- Start Navigation -->
<div class="header header-transparent change-logo">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand static-logo" href="/"><img src="frontend/img/logo-my-work.png" width="180" class="logo" alt="" /></a>
                        <a class="nav-brand fixed-logo" href="/"><img src="frontend/img/logo-my-work.png" width="180" class="logo" alt="" /></a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper">
                        <ul class="nav-menu">
                        
                            <li class="active"><a href="/">Home<span class="submenu-indicator"></span></a>
                            </li>
                            
                            
                            @foreach ($contentPages as $page)
                            @if($page->category->contains('name', 'Menu'))
                                <li><a href="{{ url('/page/' . $page->slug) }}">{{ $page->title }}</a></li>
                            @endif
                        @endforeach
                    
                        </ul>
                        
                        <ul class="nav-menu nav-menu-social align-to-right">
                            
                            @auth <!-- Ako je korisnik logovan -->
                            <li>
                                @if(auth()->user()->user_type == 'company')
                                    <a href="{{ route('company.dashboard') }}">
                                        <i class="ti-dashboard fa-lg mr-1"></i>Mein Konto
                                    </a>
                                @else
                                    <a href="{{ route('user.dashboard') }}">
                                        <i class="ti-dashboard fa-lg mr-1"></i>Mein Konto
                                    </a>
                                @endif
                            </li>
                        @endauth

                        @guest
                            <li>
                                <a href="{{ route('client-login') }}">
                                    <i class="fa fa-sign-in mr-1"></i>Anmelden
                                </a>
                            </li>
                            <li class="add-listing dark-bg">
                                <a href="{{route('company-login')}}">
                                    <i class="ti-user mr-1"></i> Als Handwerker anmelden
                                </a>
                            </li>
                        @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Navigation -->