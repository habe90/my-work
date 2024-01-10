@extends('frontend.layouts.front')
@section('content')
<!-- ============================ Page Title Start================================== -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <h2 class="ipt-title">Login</h2>
                <span class="ipn-subtitle">Login into your account</span>
                
            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- Ovdje započinje vaš postojeći HTML -->
<section class="gray-light min-sec">
    <div class="container">
        <div class="row form-submit">
            <!-- ... Ostali HTML elementi ... -->

            <!-- Livewire formular za renovaciju -->
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="login-form">
                    <h4>Anmelden</h4>
                    <form>
                        <div class="form-group">
                            <label>Benutzername</label>
                            <input type="text" class="form-control" placeholder="Benutzername">
                        </div>
                        
                        <div class="form-group">
                            <label>Passwort</label>
                            <input type="password" class="form-control" placeholder="*******">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn dark-2 btn-md full-width">Anmelden</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <span>Oder anmelden mit</span>
                    </div>
                    <div class="social_logs">
                        <ul class="shares_jobs text-center">
                            <li><a href="#" class="share fb"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="share gp"><i class="fa fa-google"></i></a></li>
                            <li><a href="#" class="share ln"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
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
<!-- Ovdje završava vaš postojeći HTML -->

@endsection