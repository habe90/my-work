
<style>
    @media (max-width: 768px) {
    .dashboard-navbar {
        position: fixed;
        bottom: -22px;
        left: 0; /* Dodano da se osigura da bottom bar počinje od lijeve ivice */
        right: 0; /* Dodano da se osigura da bottom bar ide do desne ivice */
        width: 100vw; /* Podesite širinu na 100 viewport width da prekrije cijelu širinu ekrana */
        z-index: 10;
    }

    /* Ovisno o strukturi vašeg HTML-a, možda ćete trebati resetovati marginu i padding na body ili roditeljskim elementima */
    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Sprečava horizontalni scroll */
    }

    .d-user-avater, .d-navigation {
        display: none; /* Sakrij originalni sidebar */
    }

    .bottom-nav {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: #ffffff; /* Ili bilo koja boja koju želite */
        box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        padding: 5px;
    }

    .bottom-nav a {
        text-align: center;
        flex-grow: 1;
    }

    .bottom-nav i {
        display: block;
        margin: 0 auto;
    }

    /* Ako postoje dodatni elementi koji ograničavaju širinu, resetujte njihove stilove također */
    .nekaklasa {
        padding: 0;
        margin: 0;
    }
    body, html {
    margin: 0;
    padding: 0;
    height: 100%; /* Osigurava da html i body uzimaju punu visinu */
    overflow-x: hidden; /* Sprječava horizontalno skrolovanje */
}

}


</style>

<div class="dashboard-navbar overlio-top">

    <div class="bottom-nav d-md-none"> <!-- d-md-none klasa sakriva bottom bar na uređajima većim od 768px -->
        <a href="{{ route('company.dashboard') }}">
            <i class="ti-dashboard"></i>
            <span>{{__('global.client-nav.dashboard')}}</span>
        </a>
        <!-- Ponovite za sve ostale stavke koje želite u bottom bar -->
        <a href="{{ route('messages.index') }}">
            <i class="ti-email"></i>
            <span>{{__('global.client-nav.messages')}}</span>
         
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="ti-power-off"></i>
            <span>Abmelden</span>
        </a>
    </div>
    
								
    <div class="d-user-avater">
        @if(Auth::check()) <!-- Provjera da li je korisnik prijavljen -->
            @if(Auth::user()->user_type == 'company')
                <!-- Logika za firme -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="Firma">
                <h4>#{{ Auth::user()->name }}</h4> <!-- Prikazuje ID firme -->
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
                <span><i class="ti-user"></i> {{ Auth::user()->user_type }}</span>
            @else
                <!-- Logika za obične korisnike -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="{{ Auth::user()->name }}">
                <h4>{{ Auth::user()->name }}</h4>
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
                <span><i class="ti-user"></i> {{ Auth::user()->user_type }}</span>
            @endif
        @endif
    </div>
    
    
    
    <div class="d-navigation">
        <ul id="metismenu">
            @if(Auth::user()->user_type == 'company')
                <li class="{{ request()->is('company-dashboard') ? 'active' : '' }}">
                    <a href="{{ route('company.dashboard') }}"><i class="ti-dashboard"></i>{{__('global.client-nav.dashboard')}}</a>
                </li>
                <li class="{{ request()->is('user-reviews') ? 'active' : '' }}">
                    <a href="{{ route('review.show') }}"><i class="ti-star"></i>{{__('global.client-nav.reviews')}}</a>
                </li>
                <li class="{{ request()->is('bookmarks/view') ? 'active' : '' }}">
                    <a href="{{ route('bookmarks.index') }}"><i class="ti-bookmark"></i>{{ __('global.client-nav.bookmarks') }}</a>
                </li>
                <li class="{{ request()->is('bids') ? 'active' : '' }}">
                    <a href="{{ route('bids.index') }}"><i class="ti-briefcase"></i>{{ __('global.client-nav.bids') }}</a>
                </li>
            @else
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}"><i class="ti-dashboard"></i>{{__('global.client-nav.dashboard')}}</a>
                </li>
            @endif
            <li class="{{ request()->is('user/my-profile') ? 'active' : '' }}"><a href="{{ route('users.profile') }}"><i class="ti-user"></i>{{__('global.client-nav.profile')}}</a></li>
            <li class="{{ request()->is('user/messages') ? 'active' : '' }}">
                <a href="{{ route('messages.index') }}">
                    <i class="ti-email"></i>{{__('global.client-nav.messages')}}
                    @php
                        $unreadConversations = \App\Models\ImConversation::getUnreadConversations();
                        $unreadCount = $unreadConversations['all']; 
                    @endphp
                    @if($unreadCount > 0)
                        <span class="badge badge-danger">{{ $unreadCount }}</span> 
                    @endif
                </a>
            </li>
            
       
            
         
            @can('reviews_access')
            <li><a href="#"><i class="fa fa-star"></i>{{__('global.reviews')}}</a></li>
            @endcan
        
            @can('job_access')
            <li class="{{ request()->is('manage-task', 'manage-bidders', 'active-jobs', 'post-job') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="ti-desktop"></i>{{__('global.client-nav.jobs')}}</a>
                <ul>
                    {{-- <li><a href="#">Manage Task</a></li> --}}
                    <li><a href="{{ route('bids.index') }}">Bieter verwalten</a></li>
                    <li><a href="{{ route('my-jobs') }}">{{__('global.client-nav.active_jobs')}}</a></li>
                    <li><a href="/">{{__('global.client-nav.post_job')}}</a></li>
                </ul>
            </li>
            @endcan
            <li class="add-listing dark-bg">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti-power-off"></i> Abmelden
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </li>
            
        </ul>
    </div>
    
</div>