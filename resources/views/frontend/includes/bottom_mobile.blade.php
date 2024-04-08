<style>
    @media (max-width: 768px) {
        .dashboard-navbar {
            position: fixed;
            bottom: -22px;
            left: 0;
            right: 0;
            width: 100vw;
            /* Podesite širinu na 100 viewport width da prekrije cijelu širinu ekrana */
            z-index: 10;
        }


        body,
        html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* Sprečava horizontalni scroll */
        }

        .d-user-avater,
        .d-navigation {
            display: none;
            /* Sakrij originalni sidebar */
        }

        .bottom-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: #ffffff;
            /* Ili bilo koja boja koju želite */
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


        .nekaklasa {
            padding: 0;
            margin: 0;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            /* Osigurava da html i body uzimaju punu visinu */
            overflow-x: hidden;
            /* Sprječava horizontalno skrolovanje */
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            right: -250px;
            /* Sidebar je inicijalno skriven sa desne strane */
            width: 250px;
            /* ili koliko želite */
            background: #f9f9f9;
            /* Siva boja pozadine kao na OLX */
            z-index: 100;
            transition: right 0.3s;
            /* Animacija za otvaranje i zatvaranje */
            overflow-y: auto;
            /* Omogućava skrolanje ako je sadržaj veći od visine ekrana */
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            /* Dodaje senku sa lijeve strane */
        }

        .sidebar.open {
            right: 0;
        }

        .sidebar ul {
            list-style-type: none;
            /* Uklanja bullet points */
            padding: 0;
            /* Uklanja padding */
            margin: 0;
            /* Uklanja margin */
        }

        .sidebar ul li {
            padding: 10px 15px;
            /* Dodaje padding oko linkova */
            border-bottom: 1px solid #ddd;
            /* Dodaje liniju između stavki */
        }

        .sidebar ul li a {
            text-decoration: none;
            /* Uklanja podcrtavanje linkova */
            color: #333;
            /* Tamna boja teksta */
            display: block;
            /* Čini cijelu površinu klikabilnom */
        }

        .sidebar ul li a:hover {
            background-color: #f0f0f0;
            /* Mijenja boju pozadine pri hoveru */
        }

        .sidebar .close-sidebar {
            display: block;
            text-align: right;
            padding: 10px 15px;
            font-size: 18px;
            color: #666;
            cursor: pointer;
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
    <span class="close-sidebar" onclick="toggleSidebar()">&times; Zatvori</span>
    <ul id="metismenu">
        @if (Auth::user()->user_type == 'company')
            <li><a href="{{ route('company.dashboard') }}"><i
                        class="ti-dashboard"></i>{{ __('global.client-nav.dashboard') }}</a></li>
            <li><a href="{{ route('review.show') }}"><i class="ti-star"></i>{{ __('global.client-nav.reviews') }}</a>
            </li>
            <li><a href="{{ route('bookmarks.index') }}"><i
                        class="ti-bookmark"></i>{{ __('global.client-nav.bookmarks') }}</a></li>
            <li><a href="{{ route('bids.index') }}"><i class="ti-briefcase"></i>{{ __('global.client-nav.bids') }}</a>
            </li>
        @endif
        <li><a href="{{ route('users.profile') }}"><i class="ti-user"></i>{{ __('global.client-nav.profile') }}</a>
        </li>
        <li><a href="{{ route('messages.index') }}"><i class="ti-email"></i>{{ __('global.client-nav.messages') }}</a>
        </li>
        @can('reviews_access')
            <li><a href="#"><i class="fa fa-star"></i>{{ __('global.reviews') }}</a></li>
        @endcan
        @can('job_access')
            <li><a href="{{ route('bids.index') }}"><i class="ti-desktop"></i>Bieter verwalten</a></li>
            <li><a href="{{ route('my-jobs') }}">{{ __('global.client-nav.active_jobs') }}</a></li>
            <li><a href="/">{{ __('global.client-nav.post_job') }}</a></li>
        @endcan
        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="ti-power-off"></i> Abmelden</a></li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('open');
    }
    // Možete koristiti ovu funkciju za otvaranje i zatvaranje sidebar-a.
</script>