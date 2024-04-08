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

        .user-avatar {
            text-align: center;
            /* Centriranje sadržaja */
            margin-bottom: 20px;
            /* Razmak ispod avatara */
        }

        .user-avatar img.user-image {
            width: 80px;
            /* Veličina slike */
            height: 80px;
            /* Veličina slike */
            border-radius: 50%;
            /* Okrugli oblik */
            object-fit: cover;
            /* Osigurava da se slika pravilno prilagodi */
            border: 3px solid #fff;
            /* Opcijski, dodaje border oko slike */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Opcijski, dodaje senku za 3D efekt */
            display: inline-block;
            /* Omogućava primjenu margin i padding */
            margin-top: -40px;
            /* Pomjera sliku prema gore da bi izgledala kao da je na vrhu */
        }

        .user-avatar h4.user-name {
            margin-top: 10px;
            /* Razmak iznad imena */
            color: #333;
            /* Boja teksta */
        }

        /* Sakrij sve dropdown menije */
.sidebar ul li ul {
    display: none;
}

/* Prikazuje dropdown meni kada je roditeljskom 'li' elementu dodana klasa 'open' */
.sidebar ul li.open ul {
    display: block;
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
            <a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="ti-desktop"></i>{{ __('global.client-nav.jobs') }}</a>
            <ul>
                <li><a href="{{ route('bids.index') }}">Bieter verwalten</a></li>
                <li><a href="{{ route('my-jobs') }}">{{ __('global.client-nav.active_jobs') }}</a></li>
                <li><a href="/">{{ __('global.client-nav.post_job') }}</a></li>
            </ul>
        </li>
        @endcan
      
    </ul>
   
</div>
<<script>
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



