<style>
    @media (max-width: 768px) {
        .dashboard-navbar {
            position: fixed;
            bottom: -22px;
            left: 0;
            right: 0;
            width: 100vw;
            z-index: 10;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .d-user-avater,
        .d-navigation {
            display: none;
        }

        .bottom-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: #ffffff;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
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

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            right: -250px;
            width: 250px;
            background: #f9f9f9;
            z-index: 100;
            transition: right 0.3s;
            overflow-y: auto;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar.open {
            right: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #f0f0f0;
        }

        .sidebar .close-sidebar {
            display: block;
            text-align: right;
            padding: 10px 15px;
            font-size: 18px;
            color: #666;
            cursor: pointer;
        }

        .user-avatar {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-avatar img.user-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin-top: -40px;
        }

        .user-avatar h4.user-name {
            margin-top: 10px;
            color: #333;
        }
    }
</style>

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
    <ul id="metismenu">
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
            <li><a href="{{ route('bids.index') }}"><i class="ti-desktop"></i>Bieter verwalten</a></li>
            <li><a href="{{ route('my-jobs') }}">{{ __('global.client-nav.active_jobs') }}</a></li>
            <li><a href="/">{{ __('global.client-nav.post_job') }}</a></li>
        @endcan
        {{-- <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="ti-power-off"></i> Abmelden</a></li> --}}
    </ul>
    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form> --}}
</div>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sidebar = document.getElementById('sidebar');
        var sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('open');
        });

        // Selektujemo element za zatvaranje sidebar-a koristeći klasu
        var closeSidebar = document.querySelector('.close-sidebar');

        // Dodajemo event listener za 'click' na element za zatvaranje sidebar-a
        if (closeSidebar) { // Provjeravamo da li element postoji
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        }
    });
</script>
