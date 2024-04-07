<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="https://my-work.at/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Naslov_posla" />
    <meta property="og:description" content="Kratki_opis_posla" />
    <meta property="og:image" content="URL_slike_posla" />



    <title>My Work Platform</title>
    <!-- All Plugins Css -->
    <link href="{{ asset('frontend/css/plugins.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Dodajte CSS za lightbox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <script defer src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    @livewireStyles
    @stack('styles')
</head>

<body class="blue-skin" style="overflow: visible;">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="Loader"></div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @if (Request::is('/'))
            @include('frontend.includes.navbar')
        @else
            @include('frontend.includes.navbar2')
        @endif

        @yield('content')

        @unless (Request::is('dashboard') && Agent::isMobile())
            @include('frontend.includes.footer')
        @endunless

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @livewireScripts
    @stack('scripts')
    @yield('scripts')

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/materialize.min.js') }}"></script>
    <script src="{{ asset('frontend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Dodajte JS za lightbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000"
            }
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#theme-slide-2').owlCarousel({
                loop: false,
                rewind: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
    </script>
</body>

</html>
