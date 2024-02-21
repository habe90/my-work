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
{{-- <div class="page-title bg-cover" style="background:url(https://via.placeholder.com/1920x980)no-repeat;" data-overlay="5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12"></div>
        </div>
    </div>
</div> --}}
<!-- ============================ Page Title End ================================== -->
	
			<!-- ============================ Main Section Start ================================== -->
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
							
											<li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('dashboard') }}</li>
										  </ol>
										</nav>	
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="{{ $settings1['column_class'] }}">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-1"><i class="ti-location-pin"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto"> {{ number_format($settings1['total_number']) }}</span></h4> <p> {{ $settings1['chart_title'] }}</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">	
										<div class="dashboard-stat-icon widget-2"><i class="ti-pie-chart"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">12</span></h4> <p>{{__('global.total_views')}}</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-3"><i class="ti-user"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">72</span></h4> <p>{{__('global.completed_jobs')}}</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-4"><i class="ti-bookmark"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">8</span></h4> <p>{{__('global.draft')}}</p></div>
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
													<h4 class="_jb_title">
														<a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
													</h4>
													<span class="_elopi_designation">{{ $job->description }}</span>
												</div>
												<!-- Ponude -->
												<div class="_manage_task_list_right">
													<h4>Offers:</h4>
													@forelse  ($job->bids->take(3) as $index => $bid)
														<div class="offer-card">
															<div class="user-image">
																<!-- Ubacite putanju do korisnikove slike -->
																<img src="https://elouwerse.nl/placecircle/50" alt="{{ $bid->user->name }}">
															</div>
															<div class="bid-info">
																<span class="user-name">{{ $bid->user->name }}</span>
																<span class="bid-amount">{{ $bid->amount }} €</span>
															</div>				
														</div>
												
													@empty
													<p>There is no active offers!</p>
													@endforelse
													@if($job->bids->count() > 3)
													<div class="text-center">
													<a href="{{ route('bids.show', $job->id) }}" class="btn btn-primary  btn-sm btn-block">See all</a>
												</div>
												@endif											
												</div>
											</div>
										</div><hr>
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
								<h2 class="text-light">{{ __('global.subscribe')}}</h2>
								<p class="text-light">{{ __('global.subscribe_description')}}</p>
							</div>
							<div class="inner-flexible-box subscribe-box">
								<div class="input-group">
									<input type="text" class="form-control large" placeholder="{{ __('global.enter_email')}}">
									<button class="btn btn-subscribe bg-dark" type="button"><i class="fa fa-arrow-right"></i></button>
								</div>
							</div>
						</div>              
					</div>
				</div>
			</section>
			
			<!-- ============================ Call To Action End ================================== -->

@endsection