@extends('frontend.layouts.front')
@section('content')
    <!-- ============================ Page Title Start================================== -->
   
    <!-- ============================ Page Title End ================================== -->
    <section class="gray-bg pt-4">
        <div class="container-fluid">
            <div class="row m-0">

                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    @include('frontend.includes.sidebar')
                </div>
                {{-- @if (session('success'))
                    <script>
                        toastr.success("{{ session('success') }}");
                    </script>
                @endif --}}


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
                                        <li class="breadcrumb-item active" aria-current="page">All Jobs</li>
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
                                        <h4><i class="ti-layers mr-1"></i>Mein Jobs</h4>
                                    </div>
                                </div>

                                <div class="_dashboard_content_body p-0">
                                    <div class="_grouping_list_task">

                                        @foreach ($jobs as $job)
                                            <div class="_manage_task_list">
                                                <div class="_manage_task_list_flex">
                                                    @if($job->getFirstMedia('featured_images'))
                                                    <div class="_featured_image">
                                                        <img src="{{ $job->getFirstMedia('featured_images')->getUrl() }}" alt="Featured Image" width="100px" height="100px">
                                                    </div>
                                                @endif
                                                    <h4 class="_jb_title">
                                                        <a href="{{ route('jobs.show', ['job' => myCryptie($job->id, 'encode')]) }}">{{ $job->title }}</a>
                                                    </h4>
                                                    <span
                                                        class="_elopi_designation">{{ $job->created_at->diffForHumans() }}</span>
                                                    <ul class="_action_grouping_list">
                                                        <li><a href="{{ route('jobs.edit', $job) }}" data-toggle="tooltip"
                                                                data-placement="top" title="Edit job"><i
                                                                    class="fa fa-edit"></i></a></li>
                                                        <li>
                                                            <form action="{{ route('jobs.delete', $job) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-toggle="tooltip"
                                                                    data-placement="top" title="Obriši posao">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="_manage_task_list_right">
                                                    <div class="_act_tsk_info">
                                                        @php
                                                            $statusColor = '';
                                                            if ($job->status == 'pending') {
                                                                $statusColor = 'orange';
                                                            } elseif ($job->status == 'inactive') {
                                                                $statusColor = 'red';
                                                            } elseif ($job->status == 'completed') {
                                                                $statusColor = 'green';
                                                            }
                                                        @endphp
                                                        <ul class="_act_tsk_list">


                                                            <li>
                                                                <div class="_act_capt_1">
                                                                    <h5 style="color: {{ $statusColor }};">
                                                                        {{ ucfirst($job->status) }}</h5>
                                                                    <span style="color: {{ $statusColor }};">Status</span>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{ $jobs->links('vendor.pagination.bootstrap-4') }}

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
