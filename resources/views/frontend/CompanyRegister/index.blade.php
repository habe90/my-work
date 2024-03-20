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
                                    <option value="planning">Bauplaner und -berater</option>
                                    <option value="construction">Bauunternehmen</option>
                                    <option value="concrete_drilling_cutting">Betonbohrer und -schneider</option>
                                    <option value="flooring">Boden- und Estrichleger</option>
                                    <option value="well_builder">Brunnenbauer</option>
                                    <option value="roofer">Dachdecker</option>
                                    <option value="electrician">Elektriker</option>
                                    <option value="earthwork_excavation">Erd- und Baggerunternehmen</option>
                                    <option value="window_constructor">Fenster-, Türen- und Markisenbauer</option>
                                    <option value="tiler">Fliesenleger</option>
                                    <option value="gardening_landscaping">Garten- und Landschaftsbauer</option>
                                    <option value="building_cleaner">Gebäudereiniger</option>
                                    <option value="scaffold_builder">Gerüstbauer</option>
                                    <option value="glazier">Glaser</option>
                                    <option value="heating_installer">Heizungsinstallateur</option>
                                    <option value="wood_protection">Holz- und Bautenschützer</option>
                                    <option value="interior_decorator">Innenarchitekt</option>
                                    <option value="chimney_sweeper">Kaminbauer</option>
                                    <option value="car_workshop">KFZ Werkstatt</option>
                                    <option value="air_conditioning_technician">Klimatechniker</option>
                                    <option value="kitchen_maker">Küchenbauer</option>
                                    <option value="painter_varnisher">Maler und Lackierer</option>
                                    <option value="mason_concrete_builder">Maurer und Betonbauer</option>
                                    <option value="metal_construction">Metallbauer</option>
                                    <option value="assembly_service">Montageservice & Allroundhandwerker</option>
                                    <option value="paver">Pflaster- und Straßenbauer</option>
                                    <option value="pool_builder">Poolbauer</option>
                                    <option value="room_decorator">Raumausstatter</option>
                                    <option value="plumbing">Sanitärinstallateur</option>
                                    <option value="saddler_upholsterer">Sattler und Polsterer</option>
                                    <option value="carpenter_joiner">Tischler und Schreiner</option>
                                    <option value="transport_company">Transportunternehmen</option>
                                    <option value="stair_builder">Treppenbauer</option>
                                    <option value="dry_construction">Trockenbauer</option>
                                    <option value="relocating_company">Umzugsunternehmen</option>
                                    <option value="plasterer">Verputzer</option>
                                    <option value="fence_builder">Zaunbauer</option>
                                    <option value="carpenter">Zimmerer</option>
                                </select>
                            </div>
                            <!-- Polja za unos podataka -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Firmenname</label> <!-- Ime Firme -->
                                        <input type="text" name="company_name" class="form-control"
                                            placeholder="Firmenname">
                                        @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Umsatzsteuer-Identifikationsnummer</label> <!-- Broj firme (VAT) -->
                                        <input type="text" name="vat_number" class="form-control"
                                            placeholder="Umsatzsteuer-Identifikationsnummer">
                                        @if ($errors->has('vat_number'))
                                            <span class="text-danger">{{ $errors->first('vat_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Steueridentifikationsnummer</label> <!-- Poreski broj -->
                                        <input type="text" name="tax_number" class="form-control" placeholder="Steueridentifikationsnummer">
                                        @if ($errors->has('tax_number'))
                                            <span class="text-danger">{{ $errors->first('tax_number') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
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
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Kennwort">
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
