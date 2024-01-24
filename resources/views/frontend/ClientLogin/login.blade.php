@extends('frontend.layouts.front')
@section('content')
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <h2 class="ipt-title">Anmelden</h2>
                    <span class="ipn-subtitle">Melden Sie sich bei Ihrem Konto an</span>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- Ovdje započinje vaš postojeći HTML -->
    <section class="gray-light min-sec">
        <div class="container">
            <div class="row justify-content-center">
          

                <!-- Livewire formular za renovaciju -->
                <div class="col-lg-6 col-md-8">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                @endif
                    <div class="login-form bg-white p-4 border rounded">
                        <h4>Anmelden</h4>
                        <form id="login-form" method="post">
                            @csrf
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control"  name="email" placeholder="Ihre E-mail-Addrese">
                            </div>
                            <div id="options-container" style="display: none;">
                                <!-- Ovdje će jQuery dinamički ubaciti opcije -->
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn dark-2 btn-md btn-block">Anmelden</button>
                            </div>
                        </form>
                        
                        <div class="text-center">
                            <span>Oder anmelden mit</span>
                        </div>
                        {{-- <div class="social_logs">
                        <ul class="shares_jobs text-center">
                            <li><a href="#" class="share fb"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="share gp"><i class="fa fa-google"></i></a></li>
                            <li><a href="#" class="share ln"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div> --}}
                        <div class="text-center">
                            <a href="#" class="theme-cl">Kein Konto? Registrieren</a>
                            <a href="#" class="forget-password">Passwort vergessen?</a>
                        </div>
                    </div>


                </div>

                <!-- ... Ostali HTML elementi ... -->
            </div>
        </div>
    </section>
        
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            var email = $('input[name="email"]').val();
            
            $.ajax({
                url: '/check-login', // Ovaj URL treba odgovarati vašoj POST ruti definiranoj u Laravelu
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(), // CSRF token je obavezan za POST zahtjeve u Laravelu
                    email: email // Ovako se šalje e-mail
                },
                success: function(data) {
                    if(data.userExists) {
                        window.location.href = '/login-options';
                    } else {
                        // Korisnik ne postoji, prikazati opcije
                        $('#options-container').show();
                        $('#options-container').html('<p style="color: #df3411 !important;">Der Benutzer existiert nicht. Bitte registrieren.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    // Prikazati grešku ako nešto nije u redu
                    console.error('Došlo je do greške:', error);
                }
            });
        });
    });
    </script>
    @endpush
