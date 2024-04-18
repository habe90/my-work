<!-- Top header -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header header-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand static-logo" href="/"><img
                                src="{{ asset('frontend/img/logo-my-work.png') }}" class="logo" width="180"
                                alt="" /></a>
                        <div class="nav-toggle"></div>
                    </div>
                    <div class="nav-menus-wrapper">
                        <ul class="nav-menu">
                            <li class="{{ Request::is('/') ? 'active' : '' }}">
                                <a href="/">{{ __('global.home') }}<span class="submenu-indicator"></span></a>
                            </li>
                            <li class="{{ Request::is('auftraggeber-info/so-funktionierts') ? 'active' : '' }}">
                                <a href="{{ route('how-to-work') }}">{{ __('global.how_it_works') }}<span
                                        class="submenu-indicator"></span></a>
                            </li>

                            <!-- Dinamičko dodavanje stranica u navigaciju -->
                            @foreach ($contentPages as $page)
                                @if ($page->category->contains('name', 'Menu'))
                                    <li class="{{ Request::is('page/' . $page->slug) ? 'active' : '' }}">
                                        <a href="{{ url('/page/' . $page->slug) }}">{{ $page->title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <!-- Navigacija za korisnike i registraciju -->
                        <ul class="nav-menu nav-menu-social align-to-right">
                            @auth
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
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header -->
<!-- ============================================================== -->
