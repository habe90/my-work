
<div class="dashboard-navbar overlio-top">
								
    <div class="d-user-avater">
        @if(Auth::check()) <!-- Provjera da li je korisnik prijavljen -->
            @if(Auth::user()->user_type == 'company')
                <!-- Logika za firme -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="Firma">
                <h4>#{{ Auth::user()->name }}</h4> <!-- Prikazuje ID firme -->
                <span>Type: {{ Auth::user()->user_type }}</span>
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
            @else
                <!-- Logika za obične korisnike -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="{{ Auth::user()->name }}">
                <h4>{{ Auth::user()->name }}</h4>
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
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