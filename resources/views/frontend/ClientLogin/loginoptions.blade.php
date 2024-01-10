@extends('frontend.layouts.front')
@section('content')
<style>
    .login-form .user-email {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px; /* Dodajte malo prostora ispod e-maila */
}

.login-form .user-email .user-email-text {
    font-weight: bold;
}

.login-form .user-email .change {
    color: #007bff; /* Ili bilo koju drugu boju koja se uklapa u vašu temu */
    text-decoration: underline;
    cursor: pointer;
}

.btn-outline-primary {
    border: 1px solid #007bff; /* Dodajte granicu da bi dugmad bila slična onima na slici */
}

</style>
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
  <!-- Ovdje započinje vaš postojeći HTML -->
<section class="gray-light min-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="login-form bg-white p-4 border rounded">
                    <h4 class="text-center">Einloggen bei My Work</h4>
                    <div class="user-email mt-3 mb-3">
                        <span class="user-email-text"><i class="fa fa-user-in mr-1"></i>habetech@gmail.com</span>
                        <a href="/client-login" class="change">Ändern</a>
                    </div>
                    <div class="login-options">
                        <a href="#" class="btn btn-outline-primary btn-block mt-2"><i class="fa fa-envelope-o fa-lg mr-1"></i> Link per E-Mail bekommen</a>
                        <a href="#" class="btn btn-outline-primary btn-block mt-2"> <i class="fa fa-mobile fa-lg mr-1"></i> Code per SMS bekommen</a>
                        <a href="#" class="btn btn-outline-primary btn-block mt-2"> <i class="fa fa-lock fa-lg mr-1"></i> Passwort eingeben</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush
