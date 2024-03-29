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
										<div class="dashboard-stat-content"><h4><span class="cto">{{ number_format($settings2['total_number']) }}</span></h4> <p>{{ $settings2['chart_title'] }}</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-3"><i class="ti-user"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">{{ number_format($settings3['total_number']) }}</span></h4> <p>{{ $settings3['chart_title'] }}</p></div>
									</div>	
								</div>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat">
										<div class="dashboard-stat-icon widget-4"><i class="ti-bookmark"></i></div>
										<div class="dashboard-stat-content"><h4><span class="cto">0</span></h4> <p>Saved</p></div>
									</div>	
								</div>
							</div>
								
							<div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="dashboard-gravity-list with-icons">
                                        <h4>Recent Activities</h4>
                                        <ul>
                                            @if($bids->isEmpty())
                                                <li>
                                                    No recent activity.
                                                </li>
                                            @else
                                                @foreach($bids as $bid)
                                                    <li>
                                                        @if($bid->status === 'accepted')
                                                            <i class="dash-icon-box ti-layers text-purple bg-light-purple"></i> Your bid for <strong><a href="{{ route('jobs.show', $bid->job->id) }}">{{ $bid->job->title }}</a></strong> is <span class="badge badge-success">accepted!</span>
                                                        @elseif($bid->status === 'rejected')
                                                            <i class="dash-icon-box ti-heart text-danger bg-light-danger"></i> Your bid for <strong><a href="{{ route('jobs.show', $bid->job->id) }}">{{ $bid->job->title }}</a></strong> is <span class="badge badge-danger">declined!</span>
                                                        @endif
                                                        <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                           
								@if(auth()->user() && auth()->user()->user_type == 'company')
								<div class="col-lg-6 col-md-12">
									<div class="dashboard-gravity-list invoices with-icons">
										<h4>{{ __('global.invoices') }}</h4>
										<ul>
											@forelse ($invoices as $invoice)
												<li><i class="dash-icon-box ti-files text-warning bg-light-warning"></i>
													<strong>{{ $invoice->title }}</strong>
													<ul>
														<li class="{{ $invoice->status }}">{{ $invoice->status }}</li>
														<li>Order: #{{ $invoice->id }}</li>
														<li>Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</li>

													</ul>
													<div class="buttons-to-right">
														<a href="{{ route('invoices.view', $invoice->id) }}" class="button gray">View Invoice</a>
														<a href="{{ route('invoices.download', $invoice->id) }}" class="button">Download PDF</a>
													</div>
												</li>
											@empty
												<p class="text-center mb-4">{{ __('global.no_invoices') }}</p>
											@endforelse
										</ul>
									</div>
								</div>
								
								@else
									{{-- Sadržaj koji se prikazuje samo za korisnike koji nisu tipa "company", ili za neautentificirane korisnike --}}
								@endif
								
							</div>	
							<h4 class="text-center mb-4">Relevant jobs near you</h4>
							@livewire('job-filter')
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