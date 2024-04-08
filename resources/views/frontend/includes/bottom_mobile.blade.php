<div class="bottom-nav d-md-none"> <!-- d-md-none klasa sakriva bottom bar na uređajima većim od 768px -->
    <a href="{{ route('company.dashboard') }}">
        <i class="ti-dashboard"></i>
        <span>{{ __('global.client-nav.dashboard') }}</span>
    </a>
    <!-- Ponovite za sve ostale stavke koje želite u bottom bar -->
    <a href="{{ route('messages.index') }}">
        <i class="ti-email"></i>
        <span>{{ __('global.client-nav.messages') }}</span>

    </a>
    <a href="#" id="sidebarToggle">
        <i class="ti-menu"></i>
        <span>Other</span>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="ti-power-off"></i>
        <span>Abmelden</span>
    </a>
</div>

<div id="sidebar" class="sidebar d-md-none">
    <span class="close-sidebar" onclick="toggleSidebar()">&times; Close</span>
    <div class="user-avatar">
        @if (Auth::check())
            <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}"
                alt="{{ Auth::user()->name }}" class="user-image">
            <h4 class="user-name">{{ Auth::user()->name }}</h4>
            <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
        @endif
    </div>
    <ul id="metismenu d-md-none">
        @if (Auth::user()->user_type == 'company')
            <li><a href="{{ route('review.show') }}"><i class="ti-star"></i> {{ __('global.client-nav.reviews') }}</a>
            </li>
            <li><a href="{{ route('bookmarks.index') }}"><i
                        class="ti-bookmark"></i>{{ __('global.client-nav.bookmarks') }}</a></li>
            <li><a href="{{ route('bids.index') }}"><i class="ti-briefcase"></i>
                    {{ __('global.client-nav.bids') }}</a>
            </li>
        @endif
        <li><a href="{{ route('users.profile') }}"><i class="ti-user"></i> {{ __('global.client-nav.profile') }}</a>
        </li>
        @can('reviews_access')
            <li><a href="#"><i class="fa fa-star"></i> {{ __('global.reviews') }}</a></li>
        @endcan
        @can('job_access')
            <li class="{{ request()->is('manage-task', 'manage-bidders', 'active-jobs', 'post-job') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i
                        class="ti-desktop"></i> {{ __('global.client-nav.jobs') }}</a>
                <ul>
                    <li><a href="{{ route('bids.index') }}">Bieter verwalten</a></li>
                    <li><a href="{{ route('my-jobs') }}">{{ __('global.client-nav.active_jobs') }}</a></li>
                    <li><a href="/">{{ __('global.client-nav.post_job') }}</a></li>
                </ul>
            </li>
        @endcan

    </ul>

</div>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
    }

    // Dodato za dropdown funkcionalnost
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownArrows = document.querySelectorAll('.has-arrow');
        dropdownArrows.forEach(function(arrow) {
            arrow.addEventListener('click', function(e) {
                e.preventDefault();
                var parentLi = this.parentElement;
                parentLi.classList.toggle('open');
            });
        });
    });
</script>
