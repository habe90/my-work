
<div class="dashboard-navbar overlio-top">
								
    <div class="d-user-avater">
        @if(Auth::check()) <!-- Provjera da li je korisnik prijavljen -->
            @if(Auth::user()->user_type == 'company')
                <!-- Logika za firme -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}" class="img-fluid rounded" alt="Firma">
                <h4>#{{ Auth::user()->company_id }}</h4> <!-- Prikazuje ID firme -->
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
            <li class="{{ request()->is('user/messages') ? 'active' : '' }}"><a href="{{ route('messages.index') }}"><i class="ti-email"></i>{{__('global.client-nav.messages')}}</a></li>
       
            
         
            @can('reviews_access')
            <li><a href="#"><i class="fa fa-star"></i>Reviews</a></li>
            @endcan
        
            @can('job_access')
            <li>
                <a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="ti-desktop"></i>Jobs</a>
                <ul>
                    <li><a href="manage-task.html">Manage Task</a></li>
                    <li><a href="manage-bidders.html">Manage Bidders</a></li>
                    <li><a href="active-bids.html">My Active Bids</a></li>
                    <li><a href="post-task.html">Post A Task</a></li>
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