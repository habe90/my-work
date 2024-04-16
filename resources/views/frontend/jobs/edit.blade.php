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
                                        <label for="jobTitle">Name des Jobs</label>
                                        <input type="text" class="form-control" id="jobTitle" name="title" value="{{ $job->title }}" required>
                                    </div>

                                    <!-- Featured Image -->
                                    <div class="form-group">
                                        <label for="featuredImage">Istaknuta slika</label>
                                        <input type="file" class="form-control" id="featuredImage" name="featured_image">
                                        @if($job->featured_image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $job->featured_image) }}" width="100px" height="100px" alt="Featured Image">
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Image Gallery -->
                                    <div class="form-group">
                                        <label for="imageGallery">Galerija slika</label>
                                        <input type="file" class="form-control" id="imageGallery" name="image_gallery[]" multiple>
                                        <div class="mt-2">
                                            @if($job->imageGallery)
                                                @foreach($job->imageGallery as $image)
                                                    <img src="{{ asset('storage/' . $image->path) }}" width="100px" height="100px" alt="Gallery Image">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>


        
                                    <!-- Opis posla -->
                                    <div class="form-group">
                                        <label for="jobDescription">Arbeitsbeschreibung</label>
                                        <textarea class="form-control" id="jobDescription" name="description" rows="4" required>{{ $job->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="jobLocation">Standort</label>
                                        <input type="text" class="form-control" id="jobLocation" name="location" value="{{ $job->location }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="jobStatus">Status des Jobs</label>
                                        <select class="form-control" id="jobStatus" name="status">
                                            <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>In Bearbeitung</option>
                                            <option value="completed" {{ $job->status == 'completed' ? 'selected' : '' }}>Abgeschlossen</option>
                                            <option value="in process" {{ $job->status == 'in process' ? 'selected' : '' }}>In Verarbeitung</option>
                                            <option value="canceled" {{ $job->status == 'canceled' ? 'selected' : '' }}>Storniert</option>
                                        </select>
                                    </div>
        
                                    <!-- Dugmad za akciju -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Job aktualisieren</button>
                                        <a href="{{ route('my-jobs') }}" class="btn btn-secondary">Sag es ab</a>
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
