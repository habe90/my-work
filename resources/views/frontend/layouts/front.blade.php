<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <title>My Work Platform</title>
		
        <!-- All Plugins Css -->
        <link href="{{asset('frontend/css/plugins.css')}}" rel="stylesheet">
		 

        <!-- Custom CSS -->
        <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet">
    </head>
	
    <body class="blue-skin">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="Loader"></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            @yield('content')








            





		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
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
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
		
	</body>
</html>