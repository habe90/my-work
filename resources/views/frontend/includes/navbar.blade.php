<!-- Start Navigation -->
<div class="header header-transparent change-logo">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand static-logo" href="/">
                            <img src="frontend/img/logo-my-work.png" width="180" class="logo" alt="" />
                        </a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper">
                        <ul class="nav-menu">
                            <li class="active"><a href="/">{{ __('global.home') }}<span class="submenu-indicator"></span></a></li>
                            <li><a href="{{ route('how-to-work') }}">{{ __('global.how_it_works') }}<span class="submenu-indicator"></span></a></li>
                            @foreach ($contentPages as $page)
                                @if ($page->category->contains('name', 'Menu'))
                                    <li><a href="{{ url('/page/' . $page->slug) }}">{{ $page->title }}</a></li>
                                @endif
                            @endforeach
                        </ul>

                        <ul class="nav-menu nav-menu-social align-to-right">
                            @auth <!-- Ako je korisnik logovan -->
                            @if (file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                            <!-- LanguageSwitcher komponenta -->
                            <li>
                                <livewire:language-switcher />
                            </li>
                        @endif
                              
                                <li>
                                    @if (auth()->user()->roles()->where('title', 'Admin')->exists())
                                        <a href="/admin">{{ __('global.admin_dashboard') }}</a>
                                    @elseif(auth()->user()->user_type == 'company')
                                        <a href="{{ route('company.dashboard') }}">{{ __('global.my_account') }}</a>
                                    @else
                                        <a href="{{ route('user.dashboard') }}">{{ __('global.my_account') }}</a>
                                    @endif
                                </li>
                            @endauth

                            @guest
                           
                                <li>
                                    <a href="{{ route('client-login') }}">{{ __('global.sign_in') }}</a>
                                </li>
                                <li class="add-listing dark-bg">
                                    <a href="{{ route('company-login') }}">{{ __('global.register_as_company') }}</a>
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
