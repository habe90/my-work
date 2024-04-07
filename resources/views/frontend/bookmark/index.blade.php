@extends('frontend.layouts.front')

@section('content')
    <div class="page-title bg-cover" style="background:url(https://via.placeholder.com/1920x980)no-repeat;" data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12"></div>
            </div>
        </div>
    </div>

    <section class="gray-bg pt-4">
        <div class="container-fluid">
            <div class="row m-0">

                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    @include('frontend.includes.sidebar')
                </div>

                <!-- Item Wrap Start -->
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <!-- Breadcrumbs -->
                            <div class="bredcrumb_wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Bookmarked Jobs</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- Single Wrap -->
                            <div class="_dashboard_content_body">
                                <div class="_dashboard_list_group">
                                    
                                    <!-- Single Job -->
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">Application Developer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Photoshop</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$120k - $130k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>Liverpool</span></li>
                                                        <li><span><i class="ti-timer"></i>10 min ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                                    
                                    <!-- Single Job -->
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <img src="assets/img/job-featured.png" class="_featured_jbs" alt="">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">Drupal Designer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Coffeio Inc</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$90k - $120k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>San Francisco</span></li>
                                                        <li><span><i class="ti-timer"></i>01 days ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                        
                                    <!-- Single Job -->
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">Magento Developer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Google Inc</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$110k - $130k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>Montreal, Canada</span></li>
                                                        <li><span><i class="ti-timer"></i>3 days ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                                    <!-- Single Job -->
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">Graphics Designer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Linkio</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$110k - $140k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>Montreal</span></li>
                                                        <li><span><i class="ti-timer"></i>02 days ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                                    <!-- Single Job -->
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <img src="assets/img/job-featured.png" class="_featured_jbs" alt="">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">IOS Developer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Twitter Inc</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$110k - $130k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>Denver, USA</span></li>
                                                        <li><span><i class="ti-timer"></i>05 days ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                                    <!-- Single Job -->
                                    
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">UI/UX Designer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Instagram</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$125k - $145k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>Liverpool</span></li>
                                                        <li><span><i class="ti-timer"></i>05 days ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                                    
                                    <!-- Single Job -->
                                    <div class="_list_jobs_wraps mng_list shadow_0 border">
                                        <div class="_list_jobs_f1ex first">
                                            <div class="_list_110">
                                                <div class="_list_110_thumb">
                                                    <a href="employer-detail.html"><img src="https://via.placeholder.com/250x250" class="img-fluid" alt=""></a>
                                                </div>
                                                <div class="_list_110_caption">
                                                    <h4 class="_jb_title"><a href="job-detail.html">Products Designer</a></h4>
                                                    <ul class="_grouping_list">
                                                        <li><span><i class="ti-briefcase"></i>Google Inc</span></li>
                                                        <li><span><i class="ti-credit-card"></i>$120k - $150k</span></li>
                                                        <li><span><i class="ti-location-pin"></i>San Francisco</span></li>
                                                        <li><span><i class="ti-timer"></i>10 days ago</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="_list_jobs_f1ex">
                                            <a href="#" class="_jb_apply">Remove</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Single Wrap End -->

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


@endsection
