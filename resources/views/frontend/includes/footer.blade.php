<!-- =========================== Footer Start ========================================= -->
<footer class="dark-footer skin-dark-footer">
    <div>
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <img src="{{ asset('frontend/img/logo-my-work-white.png') }}" class="img-fluid f-logo" width="180" alt="">
                        <p>Austria<br>office@my-work.at <br> +436646333336 </p>
                        <ul class="footer-bottom-social">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                            <li><a href="#"><i class="ti-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>		
                {{-- <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Useful links</h4>
                        <ul class="footer-menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">FAQs Page</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Login</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Developers</h4>
                        <ul class="footer-menu">
                            <li><a href="#">Booking</a></li>
                            <li><a href="#">Stays</a></li>
                            <li><a href="#">Adventures</a></li>
                            <li><a href="#">Author Detail</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Useful links</h4>
                        <ul class="footer-menu">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Events</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                </div> --}}
                        
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Legale Dokumente</h4>
                        <ul class="footer-menu">
                            @foreach ($contentPages as $page)
                            @if($page->category->contains('name', 'Footer'))
                                <li><a href="{{ url('/page/' . $page->slug) }}">{{ $page->title }}</a></li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">© 2024 My-Work. Designd By <a href="https://www.octagonsolution.com">OctagonSolution</a> All Rights Reserved</p>
                </div>
                
            </div>
        </div>
    </div>
</footer>
<!-- =========================== Footer End ========================================= -->