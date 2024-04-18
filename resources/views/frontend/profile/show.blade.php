@extends('frontend.layouts.front')
@section('content')
    <!-- ============================ Extra style================================== -->
    <style>
        .avatar_uploads {
            text-align: center;
            /* Centriranje sadržaja unutar div-a */
            position: relative;
            /* Pozicioniranje label-a u odnosu na ovaj div */
        }

        .user-image {
            display: block;
            /* Slika se prikazuje kao blok element */
            margin: 0 auto 10px;
            /* Centriranje slike i dodavanje margine na dnu */
            width: 150px;
            /* Širina slike */
        }

        .btn-upload {
            display: inline-block;
            /* Gumb se prikazuje kao inline-block element */
            margin: 0 auto;
            /* Centriranje gumba */
            padding: 5px 10px;
            /* Unutrašnji razmak gumba */
            font-size: .875rem;
            /* Veličina fonta gumba */
            cursor: pointer;
            /* Kursor pokazuje da je gumb klikabilan */
            background-color: #007bff;
            /* Boja pozadine gumba */
            color: white;
            /* Boja teksta gumba */
            border: none;
            /* Gumb nema obrub */
            border-radius: .25rem;
            /* Zaobljeni uglovi gumba */
        }

        .custom-file-input {
            position: absolute;
            /* Input je apsolutno pozicioniran */
            width: 100%;
            /* Širina input-a je 100% */
            height: 100%;
            /* Visina input-a je 100% */
            top: 0;
            /* Input je na vrhu */
            left: 0;
            /* Input je na lijevoj strani */
            opacity: 0;
            /* Input je nevidljiv */
            cursor: pointer;
            /* Kursor pokazuje da je input klikabilan */
        }

        .custom-file-label {
            display: none;
            /* Sakrivamo labelu */
        }
    </style>
    <!-- ============================ Edn style ================================== -->
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
                                            {{ Breadcrumbs::render('my-profile') }}</li>
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
                                            <h4><i class="fa fa-user mr-1"></i>{{ __('panel.my_account') }}</h4>
                                        </div>
                                    </div>

                                    <div class="_dashboard_content_body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar_uploads">
                                                    @if ($user->image)
                                                        <img src="{{ $user->image }}" alt="Slika korisnika"
                                                            class="user-image">
                                                        <label for="customFile"
                                                            class="btn-upload">{{ __('panel.image_alt') }}</label>
                                                    @else
                                                        <label for="customFile"
                                                            class="btn-upload">{{ __('panel.click_to_select') }}</label>
                                                    @endif
                                                    <input type="file" name="image" class="custom-file-input"
                                                        id="customFile" hidden>
                                                </div>
                                            </div>



                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{ __('panel.first_name') }}</label>
                                                            <input type="text" name="name"
                                                                class="form-control with-light"
                                                                value="{{ old('name', $user->name) }}">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{ __('panel.last_name') }}</label>
                                                            <input type="text" name="last_name"
                                                                class="form-control with-light"
                                                                value="{{ old('last_name', $user->last_name) }}">
                                                            @error('last_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{ __('panel.account_type') }}</label>
                                                            <input type="text" class="form-control with-light"
                                                                value="{{ $user->user_type }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{ __('panel.email') }}</label>
                                                            <input type="email" class="form-control with-light"
                                                                value="{{ old('email', $user->email) }}" disabled>
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
                                            <h4><i class="ti-settings mr-1"></i>{{ __('panel.my_profile') }}</h4>
                                        </div>
                                    </div>

                                    <div class="_dashboard_content_body">
                                        <div class="row">

                                            @if (Auth::check() && Auth::user()->user_type == 'company')
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('panel.company_name') }}</label>
                                                        <input type="text" name="company_name"
                                                            class="form-control with-light"
                                                            value="{{ old('company_name', $user->company_name) }}"
                                                            disabled>
                                                        @error('company_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('panel.vat_number') }}</label>
                                                        <input type="text" name="vat_number"
                                                            class="form-control with-light"
                                                            value="{{ old('vat_number', $user->vat_number) }}">
                                                        @error('vat_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('panel.tax_number') }}</label>
                                                        <input type="text" name="tax_number"
                                                            class="form-control with-light"
                                                            value="{{ old('tax_number', $user->tax_number) }}">
                                                        @error('tax_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('panel.radius_in_km') }}</label>
                                                        <div class="rg-slider">
                                                            <input type="text" class="js-range-slider" name="radius"
                                                                value="{{ old('radius', $user->radius) }}" />
                                                        </div>
                                                        @error('radius')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-xl-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>{{ __('panel.phone') }}</label>
                                                    <input type="text" name="phone" class="form-control with-light"
                                                        value="{{ old('phone', $user->phone) }}">
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="form-group with-light">
                                                    <label>{{ __('panel.address') }}</label>
                                                    <input type="text" name="address" class="form-control with-light"
                                                        value="{{ old('address', $user->address) }}">
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('panel.about_yourself') }}</label>
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
                                            <h4><i class="ti-lock mr-1"></i>{{ __('panel.set_password') }}</h4>
                                        </div>
                                    </div>

                                    <div class="_dashboard_content_body">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>{{ __('panel.old_password') }}</label>
                                                    <input type="password" name="old_password"
                                                        class="form-control with-light @error('old_password') is-invalid @enderror">
                                                    @error('old_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>{{ __('panel.new_password') }}</label>
                                                    <input type="password" name="new_password"
                                                        class="form-control with-light">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>{{ __('panel.confirm_password') }}</label>
                                                    <input type="password" name="new_password_confirmation"
                                                        class="form-control with-light">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Single Wrap End -->

                                <button type="submit" class="btn btn-save">{{ __('panel.save_changes') }}</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Dohvatite staru vrijednost ili trenutnu vrijednost radiusa
            var radiusValue = "{{ old('radius', $user->radius) }}";

            // Inicijalizujte ionRangeSlider sa PHP vrijednostima
            $(".js-range-slider").ionRangeSlider({
                type: "double",
                min: 0,
                max: 500,
                from: 0,
                to: radiusValue,
                grid: true
            });

            // Handler za promjenu vrijednosti slidera
            $('.js-range-slider').on('change', function() {
                var $this = $(this),
                    value = $this.prop("value").split(";");

                var fromValue = parseInt(value[0]),
                    toValue = parseInt(value[1]);

                $this.data("from", fromValue);
                $this.data("to", toValue);
            });
        });
    </script>
@endpush
