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
                                        <li class="breadcrumb-item active" aria-current="page">Edit job</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="_dashboard_content_body p-0">
                                <form action="{{ route('jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                
                                    <!-- Naslov posla -->
                                    <div class="form-group">
                                        <label for="jobTitle">{{ __('panel.job_title') }}</label>
                                        <input type="text" class="form-control" id="jobTitle" name="title" value="{{ $job->title }}" required>
                                    </div>
                                
                                    <!-- Featured Image -->
                                    <div class="form-group">
                                        <label for="featuredImage">{{ __('panel.featured_image') }}</label>
                                        <input type="file" class="form-control" id="featuredImage" name="featured_image">
                                        @if($job->getFirstMedia('featured_images'))
                                        <div class="mt-2">
                                            <img src="{{ $job->getFirstMedia('featured_images')->getUrl() }}" width="100px" height="100px" alt="{{ __('panel.featured_image') }}">
                                        </div>
                                        @endif
                                    </div>
                                
                                    <!-- Image Gallery -->
                                    <div class="form-group">
                                        <label for="imageGallery">{{ __('panel.image_gallery') }}</label>
                                        <input type="file" class="form-control" id="imageGallery" name="image_gallery[]" multiple>
                                        <div class="mt-2">
                                            @foreach($job->getMedia('image_gallery') as $image)
                                                <img src="{{ $image->getUrl() }}" width="100px" height="100px" alt="{{ __('panel.image_gallery') }}">
                                            @endforeach
                                        </div>
                                    </div>
                                
                                    <!-- Opis posla -->
                                    <div class="form-group">
                                        <label for="jobDescription">{{ __('panel.job_description') }}</label>
                                        <textarea class="form-control" id="jobDescription" name="description" rows="4" required>{{ $job->description }}</textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="jobLocation">{{ __('panel.job_location') }}</label>
                                        <input type="text" class="form-control" id="jobLocation" name="location" value="{{ $job->location }}">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="jobStatus">{{ __('panel.job_status') }}</label>
                                        <select class="form-control" id="jobStatus" name="status">
                                            <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>{{ __('panel.pending') }}</option>
                                            <option value="completed" {{ $job->status == 'completed' ? 'selected' : '' }}>{{ __('panel.completed') }}</option>
                                            <option value="in process" {{ $job->status == 'active' ? 'selected' : '' }}>{{ __('panel.active') }}</option>
                                            <option value="in process" {{ $job->status == 'in process' ? 'selected' : '' }}>{{ __('panel.in_process') }}</option>
                                            <option value="canceled" {{ $job->status == 'canceled' ? 'selected' : '' }}>{{ __('panel.canceled') }}</option>
                                        </select>
                                    </div>
                                
                                    <!-- Dugmad za akciju -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('panel.update_job') }}</button>
                                        <a href="{{ route('my-jobs') }}" class="btn btn-secondary">{{ __('panel.cancel') }}</a>
                                    </div>
                                </form>
                                
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
