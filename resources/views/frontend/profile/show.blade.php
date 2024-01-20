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
                              
                                <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('my-profile') }}</li>
                              </ol>
                            </nav>	
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <!-- Single Wrap -->
                        <div class="_dashboard_content">
                            <div class="_dashboard_content_header">
                                <div class="_dashboard__header_flex">
                                    <h4><i class="fa fa-user mr-1"></i>My Account</h4>	
                                </div>
                            </div>
                            
                            <div class="_dashboard_content_body">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="custom-file avater_uploads">
                                            <input type="file" name="image" class="custom-file-input" id="customFile">
                                            @if($user->image)
                                            <img src="{{ $user->image }}" alt="Slika korisnika" width="150">
                                            @else
                                            <label class="custom-file-label" for="customFile"><i class="fa fa-user"></i></label>
                                            @endif
                                        </div>
                                        <!-- Prikaz slike korisnika -->
                                       
                                    </div>
                                    
                                    
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="name" class="form-control with-light" value="{{ old('name', $user->name) }}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" class="form-control with-light" value="{{ old('last_name', $user->last_name) }}">
                                                    @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Account Type</label>
                                                    <input type="text" class="form-control with-light" value="{{ $user->user_type }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control with-light" value="{{ old('email', $user->email) }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Single Wrap End -->
                        
                        <!-- Single Wrap -->
                        <div class="_dashboard_content">
                            <div class="_dashboard_content_header">
                                <div class="_dashboard__header_flex">
                                    <h4><i class="ti-settings mr-1"></i>My Profile</h4>	
                                </div>
                            </div>
                            
                            <div class="_dashboard_content_body">
                                <div class="row">
                                        
                                    
                                    
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control with-light" value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="form-group with-light">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control with-light" value="{{ old('address', $user->address) }}">
                                                @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label>About Yourself</label>
                                            <textarea name="about" class="form-control with-light">{{ old('about', $user->about) }}</textarea>
                                            @error('about')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Single Wrap End -->
                        
                        <!-- Single Wrap -->
                        <div class="_dashboard_content">
                            <div class="_dashboard_content_header">
                                <div class="_dashboard__header_flex">
                                    <h4><i class="ti-lock mr-1"></i>Set Password</h4>	
                                </div>
                            </div>
                            
                            <div class="_dashboard_content_body">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" name="old_password" class="form-control with-light @error('old_password') is-invalid @enderror">
                                            @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="new_password" class="form-control with-light">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="new_password_confirmation" class="form-control with-light">
                                        </div>
                                    </div>
                               
                                </div>
                            </div>
                        </div>
                        <!-- Single Wrap End -->
                        
                        <button type="submit" class="btn btn-save">Save Changes</button>
                        </form>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</section>
@endsection