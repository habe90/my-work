<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta property="og:url"           content="http://127.0.0.1:8000" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Naslov_posla" />
		<meta property="og:description"   content="Kratki_opis_posla" />
		<meta property="og:image"         content="URL_slike_posla" />


        <title>My Work Platform</title>
        <!-- All Plugins Css -->
        <link href="{{asset('frontend/css/plugins.css')}}" rel="stylesheet">
			
        <!-- Custom CSS -->
        <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet">
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
			@if(Request::is('/'))
			@include('frontend.includes.navbar')
			@else
				@include('frontend.includes.navbar2')
			@endif

            @yield('content')
		
			@include('frontend.includes.footer')

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
		
		<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
		<script src="{{asset('frontend/js/popper.min.js')}}"></script>
		<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('frontend/js/select2.min.js')}}"></script>
		<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
		<script src="{{asset('frontend/js/ion.rangeSlider.min.js')}}"></script>
		<script src="{{asset('frontend/js/counterup.min.js')}}"></script>
		<script src="{{asset('frontend/js/materialize.min.js')}}"></script>
		<script src="{{asset('frontend/js/metisMenu.min.js')}}"></script>
		<script src="{{asset('frontend/js/custom.js')}}"></script>
		<script src="{{asset('frontend/js/ion.rangeSlider.min.js')}}"></script>
		<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

		<script src="{{ mix('js/app.js') }}" defer></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
		
	</body>
</html>