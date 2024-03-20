<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function CompanyRegister(){
        if (auth()->check()) {
            return redirect('/');
        }
        
        return view('frontend.CompanyRegister.index');
    }


        public function store(Request $request)
    {
        // Pravila za validaciju
        $rules = [
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:20',
            'address' => 'required|max:255',
            'password' => 'required|min:6',
            'activity' => 'required',
            'company_name' => 'required|max:255',
            'vat_number' => 'required|max:255',
       
        ];

        // Poruke za greške
        $messages = [
            'required' => 'Das Feld :attribute ist erforderlich.',
            'email' => 'Das Feld :attribute muss eine gültige E-Mail-Adresse sein.',
            'unique' => 'Das Feld :attribute existiert bereits.',
            'min' => 'Das Feld :attribute muss mindestens :min Zeichen enthalten.'
        ];
        

        // Izvršavanje validacije
        $this->validate($request, $rules, $messages);

        $latestCompanyUser = User::where('user_type', 'company')->orderBy('company_id', 'desc')->first();

        if ($latestCompanyUser) {
            // Ako postoje korisnici firmi, povećajte 'company_id' za 100
            $newCompanyId = $latestCompanyUser->company_id + 100;
        } else {
            // Ako nema postojećih korisnika firmi, postavite početni 'company_id' na 100
            $newCompanyId = 100;
        }

        // Kreiranje novog korisnika
        $user = new User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password); 
        $user->user_type = 'company'; 
        $user->status = 'pending'; 
        $user->activity = $request->activity;
        $user->company_name = $request->company_name;
        $user->vat_number = $request->vat_number;
        $user->company_id = $newCompanyId;
        $user->tax_number = $request->tax_number;

        $user->save(); 

        $user->sendEmailVerificationNotification();


        // Redirect nakon uspješne registracije
 
       return redirect()->to('/client-login')->with('success', 'Ihr Konto wurde registriert. Bitte bestätigen Sie Ihre E-Mail.');

    }


    public function afterRegistration()
{
    // Provjerite da li u sesiji postoje podaci forme
    if (session()->has('form_data')) {
        // Ako postoji, preuzmite podatke forme
        $formData = session('form_data');
        // Ovdje pozovite insertData ili drugu metodu za obradu podataka forme
        $this->insertData(new Request($formData));

        // Nakon obrade, uklonite podatke iz sesije
        session()->forget('form_data');
    }

    return redirect()->to('/dashboard')->with('success', 'Ihr Konto wurde registriert. Bitte bestätigen Sie Ihre E-Mail.');
}
}
