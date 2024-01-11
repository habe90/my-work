@extends('frontend.layouts.front')
@section('content')
<style>
	.offer-card {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.user-image img {
    width: 50px; /* Ili bilo koja druga veličina */
    height: 50px;
    border-radius: 50%; /* Da bi slika bila u obliku kruga */
    object-fit: cover;
    margin-right: 10px;
}

.bid-info .user-name {
    font-weight: bold;
}

.bid-info .bid-amount {
    background-color: #green; /* Prilagodite boju pozadine */
    color: black;
    padding: 5px 10px;
    border-radius: 15px;
}

</style>

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
								<div class="_dashboard_content">
									<!-- Ponude -->
									@foreach ($jobs as $job)
										<div class="_grouping_list_task">
											<div class="_manage_task_list">
												<!-- Naslov posla i opis -->
												<div class="_manage_task_list_flex">
													<h4 class="_jb_title">{{ $job->title }}</h4>
													<span class="_elopi_designation">{{ $job->description }}</span>
												</div>
												<!-- Ponude -->
												<div class="_manage_task_list_right">
													<h4>Offers:</h4>
													@foreach ($job->bids->take(3) as $index => $bid)
														<div class="offer-card">
															<div class="user-image">
																<!-- Ubacite putanju do korisnikove slike -->
																<img src="https://elouwerse.nl/placecircle/50" alt="{{ $bid->user->name }}">
															</div>
															<div class="bid-info">
																<span class="user-name">{{ $bid->user->name }}</span>
																<span class="bid-amount">{{ $bid->amount }} KM</span>
															</div>				
														</div>
													@endforeach
													@if($job->bids->count() > 3)
													<div class="text-center">
													<a href="{{ route('bids.show', $job->id) }}" class="btn btn-primary  btn-sm btn-block">See all</a>
												</div>
												@endif
												

												</div>
											</div>
										</div>
									@endforeach
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