@extends('frontend.layouts.front')
@section('content')
    <style>
        .login-form .user-email {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            /* Dodajte malo prostora ispod e-maila */
        }

        .login-form .user-email .user-email-text {
            font-weight: bold;
        }

        .login-form .user-email .change {
            color: #007bff;
            /* Ili bilo koju drugu boju koja se uklapa u vašu temu */
            text-decoration: underline;
            cursor: pointer;
        }

        .btn-outline-primary {
            border: 1px solid #007bff;
            /* Dodajte granicu da bi dugmad bila slična onima na slici */
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
                        @auth
                        <div class="alert alert-success">
                            Sie sind bereits eingeloggt. <a href="/dashboard">Zurück zum Dashboard</a> oder <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Ausloggen</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="user-email mt-3 mb-3">
                            <span class="user-email-text"><i class="fa fa-user-in mr-1"></i>{{ session('user_email') }}</span>
                            <a href="/client-login" class="change">(Ändern)</a>
                        </div>
                        <div class="login-options">
                            @livewire('login-link-sender', ['email' => session('user_email')])
                        </div>
                    @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
