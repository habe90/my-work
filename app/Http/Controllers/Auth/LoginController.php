<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function CheckOrRegister(Request $request)
    {
        $email = $request->input('email');

        // Provjerite postoji li korisnik sa datim emailom
        $userExists = User::where('email', $email)->exists();

        if ($userExists) {
            // Ako korisnik postoji, preusmjerite na stranicu za prijavu
            return redirect()->route('login');
        } else {
            // Ako korisnik ne postoji, preusmjerite na stranicu za registraciju
            // Sačuvajte email u sesiji da ga možete automatski popuniti na formi za registraciju
            session(['email' => $email]);
            return redirect()->route('register');
        }
    }

    public function loadCheckEmail(){
        
        return view('frontend.ClientLogin.checkemail');
    }
}
