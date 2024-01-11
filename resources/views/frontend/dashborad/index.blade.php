@extends('frontend.layouts.front')
@section('content')

<!-- ============================ Page Title Start================================== -->
<div class="page-title bg-cover" style="background:url(https://via.placeholder.com/1920x980)no-repeat;" data-overlay="5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12"></div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->
	
			<!-- ============================ Main Section Start ================================== -->
			<section class="gray-bg pt-4">
				<div class="container-fluid">
					<div class="row m-0">
						
						<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
							<div class="dashboard-navbar overlio-top">
								
                                <div class="d-user-avater">
                                    @if(Auth::check()) <!-- Provjera da li je korisnik prijavljen -->
                                        <img src="https://via.placeholder.com/500x500" class="img-fluid rounded" alt="{{ Auth::user()->name }}">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <span>{{ Auth::user()->address }}</span>
                                    @endif
                                </div>
                                
								
								<div class="d-navigation">
									<ul id="metismenu">
										<li class="active"><a href="dashboard.html"><i class="ti-dashboard"></i>{{__('global.client-nav.dashboard')}}</a></li>
										<li><a href="my-profile.html"><i class="ti-user"></i>{{__('global.client-nav.profile')}}</a></li>
										<li><a href="messages.html"><i class="ti-email"></i>{{__('global.client-nav.messages')}}</a></li>
										<li>
											<a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="ti-bookmark-alt"></i>Bookmark</a>
											<ul>
												<li><a href="bookmark-jobs.html">Bookmark jobs</a></li>
												<li><a href="bookmark-candidates.html">Bookmark Candidates</a></li>
												<li><a href="bookmark-freelancers.html">Bookmark Freelancers</a></li>
												<li><a href="bookmark-employers.html">Bookmark Employers</a></li>
											</ul>
										</li>
										<li><a href="reviews.html"><i class="fa fa-star"></i>Reviews</a></li>
										<li>
											<a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="fa fa-briefcase"></i>Jobs</a>
											<ul>
												<li><a href="manage-jobs.html">Manage Jobs</a></li>
												<li><a href="manage-candidates.html">Manage Candidates</a></li>
												<li><a href="manage-freelancers.html">Manage Freelancers</a></li>
												<li><a href="manage-employers.html">Manage Employers</a></li>
												<li><a href="create-reume.html">Create Resume</a></li>
												<li><a href="post-job.html">Post A Job</a></li>
												
											</ul>
										</li>
										<li>
											<a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="ti-desktop"></i>Tasks</a>
											<ul>
												<li><a href="manage-task.html">Manage Task</a></li>
												<li><a href="manage-bidders.html">Manage Bidders</a></li>
												<li><a href="active-bids.html">My Active Bids</a></li>
												<li><a href="post-task.html">Post A Task</a></li>
											</ul>
										</li>
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
						</div>
						
						<!-- Item Wrap Start -->
						<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<!-- Breadcrumbs -->
									<div class="bredcrumb_wrap">
										<nav aria-label="breadcrumb">
										  <ol class="breadcrumb">
							
											<li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('dashboard') }}</li>
										  </ol>
										</nav>	
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-1"><i class="ti-location-pin"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">72</span></h4> <p>Job Posted</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">	
										<div class="dashboard-stat-icon widget-2"><i class="ti-pie-chart"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">12</span>M</h4> <p>Total Viewed</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-3"><i class="ti-user"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">72</span>K</h4> <p>User Applied</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-4"><i class="ti-bookmark"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">80</span></h4> <p>Job Bookmarked</p></div>
									</div>	
								</div>
							</div>
								
							<div class="row">
								<div class="col-lg-6 col-md-12">
									<div class="dashboard-gravity-list with-icons">
										<h4>{{__('global.activeWorkPosts')}}</h4>
										<ul>
											<li>
												<i class="dash-icon-box ti-layers text-purple bg-light-purple"></i> Your job for <strong><a href="#">IOS Developer</a></strong> has been approved!
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>

											<li>
												<i class="dash-icon-box ti-star text-success bg-light-success"></i> Jodie Farrell left a review <div class="numerical-rating high" data-rating="5.0"></div> for<strong><a href="#"> Real Estate Logo</a></strong>
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>

											<li>
												<i class="dash-icon-box ti-heart text-warning bg-light-warning"></i> Someone bookmarked your <strong><a href="#">SEO Expert Job</a></strong> listing!
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>

											<li>
												<i class="dash-icon-box ti-star text-info bg-light-info"></i> Gracie Mahmood left a review <div class="numerical-rating mid" data-rating="3.8"></div> on <strong><a href="#">Product Design</a></strong>
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>

											<li>
												<i class="dash-icon-box ti-heart text-danger bg-light-danger"></i> Your Magento Developer job expire<strong><a href="#">Renew</a></strong> now it!
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>

											<li>
												<i class="dash-icon-box ti-star text-success bg-light-success"></i> Ethan Barrett left a review <div class="numerical-rating high" data-rating="4.7"></div> on <strong><a href="#">New Logo</a></strong>
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>

											<li>
												<i class="dash-icon-box ti-star text-purple bg-light-purple"></i> Your Magento Developer job expire <strong><a href="#">Renew</a></strong> now it.
												<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
											</li>
										</ul>
									</div>
								</div>
								@if(auth()->user() && auth()->user()->user_type == 'company')
								<div class="col-lg-6 col-md-12">
									<div class="dashboard-gravity-list invoices with-icons">
										<h4>{{ __('global.invoices')}}</h4>
										<ul>
											
											<li><i class="dash-icon-box ti-files text-warning bg-light-warning"></i>
												<strong>Starter Plan</strong>
												<ul>
													<li class="unpaid">Unpaid</li>
													<li>Order: #20551</li>
													<li>Date: 01/08/2019</li>
												</ul>
												<div class="buttons-to-right">
													<a href="dashboard-invoice.html" class="button gray">View Invoice</a>
												</div>
											</li>
										

										</ul>
									</div>
								</div>	
								@else
									{{-- Sadržaj koji se prikazuje samo za korisnike koji nisu tipa "company", ili za neautentificirane korisnike --}}
								@endif
							</div>	
							
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Main Section End ================================== -->
            
			<!-- ============================ Call To Action Start ================================== -->
			<section class="call-to-act" style="background:#0b85ec url(assets/img/landing-bg.png) no-repeat">
				<div class="container">
					<div class="row justify-content-center">
					
						<div class="col-lg-7 col-md-8">
							<div class="clt-caption text-center mb-4">
								<h2 class="text-light">Subscribe Now!</h2>
								<p class="text-light">Simple pricing plans. Unlimited web maintenance service</p>
							</div>
							<div class="inner-flexible-box subscribe-box">
								<div class="input-group">
									<input type="text" class="form-control large" placeholder="Enter your mail here">
									<button class="btn btn-subscribe bg-dark" type="button"><i class="fa fa-arrow-right"></i></button>
								</div>
							</div>
						</div>				
					</div>
				</div>
			</section>
			<!-- ============================ Call To Action End ================================== -->

@endsection