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
                                        <li class="breadcrumb-item active" aria-current="page">Bookmarks</li>
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
                                        <h4><i class="fa fa-user mr-1"></i>Angebote verwalten</h4>
                                    </div>
                                </div>

                                <div class="_dashboard_content_body">
                                    <div class="row">
                                        @if($userBids->count() > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Jobtitel</th>
                                                    <th>Angebot</th>
                                                    <th>Datum</th>
                                                    <!-- Fügen Sie hier zusätzliche Spalten nach Bedarf ein -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userBids as $bid)
                                                    <tr>
                                                        <td>{{ $bid->job->title }}</td>
                                                        <td>{{ $bid->amount }}</td>
                                                        <td>{{ $bid->created_at->format('d.m.Y') }}</td>
                                                
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                        
                                        <!-- Pagination -->
                                        <div class="pagination-wrap">
                                            {{ $userBids->links() }}
                                        </div>
                                    @else
                                        <p>Sie haben derzeit keine Angebote.</p>
                                    @endif


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
