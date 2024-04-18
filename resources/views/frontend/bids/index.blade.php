@extends('frontend.layouts.front')

@section('content')

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
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('cruds.bids.title') }}
                                        </li>
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
                                        <h4><i class="fa fa-user mr-1"></i>{{ __('cruds.bids.manage') }}</h4>
                                    </div>
                                </div>

                                <div class="_dashboard_content_body">
                                    <div class="row">
                                        @if ($userBids->count() > 0)
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('cruds.bids.job_title') }}</th>
                                                        <th>{{ __('cruds.bids.offer') }}</th>
                                                        <th>{{ __('cruds.bids.status') }}</th>
                                                        <th>{{ __('cruds.bids.date') }}</th>
                                                        <!-- Add additional columns here as needed -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($userBids as $bid)
                                                        <tr>

                                                            <td>
                                                                @if (auth()->user()->user_type == 'client')
                                                                    {{-- Ako je korisnik vlasnik posla, link vodi na stranicu za pregled ponuda --}}
                                                                    <a
                                                                        href="{{ route('bids.show', ['job' => $bid->job->id]) }}">{{ $bid->job->title }}</a>
                                                                @else
                                                                    {{-- Ako je korisnik firma, koristimo trenutnu logiku --}}
                                                                    <a
                                                                        href="{{ route('jobs.show', ['job' => myCryptie($bid->job->id, 'encode')]) }}">{{ $bid->job->title }}</a>
                                                                @endif
                                                            </td>
                                                            <td><b>{{ $bid->amount }}</b></td>
                                                            <td>{{ $bid->status }}</td>
                                                            <td>{{ $bid->created_at->format('d.m.Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <!-- Pagination -->
                                            <div class="pagination-wrap">
                                           
                                                {{ $userBids->links('vendor.pagination.bootstrap-4') }}
                                            </div>
                                        @else
                                            <p>{{ __('cruds.bids.no_offers') }}</p>
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
