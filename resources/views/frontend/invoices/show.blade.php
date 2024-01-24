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

                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ Breadcrumbs::render('user-reviews') }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- Single Wrap -->
                            <div class="_dashboard_content">
                                <div class="_dashboard_content_header">
                                    <div class="_dashboard__header_flex">
                                        <h4><i class="fa fa-star mr-1"></i>Invoice preview</h4>
                                    </div>
                                </div>

                                <div class="_dashboard_content_body p-0">
                                    @forelse($invoices as $index => $invoice)
                                    <div class="receipt-main col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                        
                                        <!-- Prikaz rednog broja fakture -->
                                        <div class="badge-container">
                                            <!-- Ovdje se postavlja oznaka statusa fakture -->
                                            <span class="badge {{ $invoice->is_paid ? 'badge-success' : 'badge-danger' }}">
                                                {{ $invoice->is_paid ? 'Paid' : 'Not paid' }}
                                            </span>
                                        </div>
                                
                                        <div class="receipt-header receipt-header-mid">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="receipt-left">
                                                    <h3>Inovice #{{ $invoice->id }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-md-9">Plaćanje za Jan 2024</td>
                                                        <td class="col-md-3"><i class="fa fa-eur"></i> {{ $invoice->amount }}</td>
                                                    </tr>
                                                    <!-- Dodajte ostale redove s dinamičkim podacima -->
                                                </tbody>
                                            </table>
                                        </div>
                                
                                        <div class="receipt-header receipt-header-mid receipt-footer">
                                            <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                                <div class="receipt-right">
                                                    <p><b>Date :</b> {{ $invoice->created_at->format('d M Y') }}</p>
                                                    <img src="{{asset('frontend/img/logo-my-work.png')}}"  class="img-fluid f-logo" width="180" alt="">
                                                    <h5 style="color: rgb(140, 140, 140);">Danke für Ihren Einkauf!</h5>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div> 
                                    @empty
                                    <p>Nema dostupnih faktura.</p>
                                    @endforelse
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
@push('styles')
    <style>

.invoice-preview {
    position: relative;
    /* ostali stilovi */
}

.badge-container {
    position: absolute;
    right: 42px; /* ili koliko god je potrebno da se pomjeri desno */
    top: 15px; /* ili koliko god je potrebno da se pomjeri gore */
}

.badge-success {
    background-color: #28a745; /* Zelena boja za plaćene fakture */
}

.badge-danger {
    background-color: #dc3545; /* Crvena boja za neplaćene fakture */
}
        body {
            background: #eee;
            margin-top: 20px;
        }

        .text-danger strong {
            color: #9f181c;
        }

        .receipt-main {
            background: #ffffff none repeat scroll 0 0;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #9f181c;
            margin-bottom: 50px;
            padding: 40px 30px !important;
            position: relative;
            color: #333333;
            font-family: open sans;
        }

        .receipt-main p {
            color: #333333;
            font-family: open sans;
            line-height: 1.42857;
        }

        .receipt-footer h1 {
            font-size: 15px;
            font-weight: 400 !important;
            margin: 0 !important;
        }

        .receipt-main::after {
            background: #414143 none repeat scroll 0 0;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }

        .receipt-main thead {
            background: #414143 none repeat scroll 0 0;
        }

        .receipt-main thead th {
            color: #fff;
        }

        .receipt-right h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 7px 0;
        }

        .receipt-right p {
            font-size: 12px;
            margin: 0px;
        }

        .receipt-right p i {
            text-align: center;
            width: 18px;
        }

        .receipt-main td {
            padding: 9px 20px !important;
        }

        .receipt-main th {
            padding: 13px 20px !important;
        }

        .receipt-main td {
            font-size: 13px;
            font-weight: initial !important;
        }

        .receipt-main td p:last-child {
            margin: 0;
            padding: 0;
        }

        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }

        .receipt-header-mid .receipt-left h1 {
            font-weight: 100;
            margin: 34px 0 0;
            text-align: right;
            text-transform: uppercase;
        }

        .receipt-header-mid {
            margin: 24px 0;
            overflow: hidden;
        }

        #container {
            background-color: #dcdcdc;
        }
    </style>
@endpush
