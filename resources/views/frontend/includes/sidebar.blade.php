<style>
/* Stil za trakice */
.user-info-badges {
    position: absolute;
    top: 50%; 
    right: -40px; /* Prilagođeno kako bi trakice izašle izvan kartice */
    transform: translate(0, -50%);
    display: flex;
    flex-direction: column;
}

.user-info-badges span {
    position: absolute;
    right: -100%; /* Ako je potrebno, prilagodite ovu vrijednost */
    transform-origin: top right; /* Tačka oko koje se vrši rotacija */
    transform: rotate(270deg) translateX(-100%); /* Rotacija i pomjeranje trakice */
    background-color: #333;
    color: white;
    padding: 5px;
    margin-bottom: 5px;
    border-radius: 5px;
    white-space: nowrap;
}

/* Stil za svaku trakicu */
.user-location-badge,
.user-type-badge {
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    background-color: #333;
    color: white;
    padding: 5px;
    margin-bottom: 5px;
    border-radius: 5px;
    white-space: nowrap; /* Osigurava da se tekst ne prelama */
    overflow: hidden; /* Skriva sve izvan granica */
    text-overflow: ellipsis; /* Dodaje "..." ako tekst prelazi širinu */
}

/* Podešava veličinu slike i poravnanje unutar kartice */
.d-user-avater img {
    max-width: 80px; /* Prilagoditi prema stvarnoj širini slike */
    height: auto;
    border-radius: 50%; /* Zaokružuje sliku */
}

/* Ako je potrebno, prilagodite roditeljski kontejner */
.d-user-avater {
    position: relative; /* Potrebno za apsolutno pozicioniranje trakica */
    display: flex; /* Ako želite fleksibilno rasporediti elemente */
    align-items: center; /* Vertikalno centriranje sadržaja */
    justify-content: start; /* Poravnanje sadržaja na početak */
}


</style>
<div class="dashboard-navbar overlio-top">
								
    <div class="d-user-avater">
        @if(Auth::check()) <!-- Provjera da li je korisnik prijavljen -->
            @if(Auth::user()->user_type == 'company')
                <!-- Logika za firme -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="Firma">
                <h4>#{{ Auth::user()->name }}</h4> <!-- Prikazuje ID firme -->
                <div class="user-info-badges">
                    <span class="user-location-badge"><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
                    <span class="user-type-badge"><i class="ti-user"></i>{{ Auth::user()->user_type }}</span>
                </div>
            @else
                <!-- Logika za obične korisnike -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="{{ Auth::user()->name }}">
                <h4>{{ Auth::user()->name }}</h4>
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
                <span><i class="ti-user"></i>{{ Auth::user()->user_type }}</span>
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