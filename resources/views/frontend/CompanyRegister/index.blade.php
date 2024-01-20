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
    <section class="gray-light">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Forma za registraciju firme -->
                <div class="col-lg-8 col-md-9 col-sm-12">

                    <div class="login-form bg-white p-4 border rounded">
                        <h4>Registrieren</h4>
                        <form id="register-form" method="post" action="{{ route('company-save') }}">
                            @csrf
                            <!-- Odabir djelatnosti -->
                            <div class="form-group">
                                <label for="activity">Tätigkeitsbereich</label>
                                <select id="activity" name="activity" class="form-control">
                                    <!-- Opcije poput onih sa slike -->
                                    <option value="demolition">Abriss- und Entsorgungsunternehmen</option>
                                    <!-- Ostale opcije -->
                                </select>
                            </div>
                            <!-- Polja za unos podataka -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Vorname</label>
                                        <input type="text" name="name" class="form-control" placeholder="Vorname">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nachname</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Nachname">
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="E-mail Adresse">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Telefon</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Telefonnummer">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Adresse</label>
                                        <input type="text" name="address" class="form-control" placeholder="Adresse">
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kennwort (Mindestens 6 Zeichen)</label>
                                        <input type="password" name="password" class="form-control" placeholder="Kennwort">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn dark-2 btn-md full-width">Registrieren</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="text-center">
                            <a href="#" class="theme-cl">Bereits ein Konto? Anmelden</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
