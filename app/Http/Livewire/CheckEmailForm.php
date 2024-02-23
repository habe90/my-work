<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Auth;

class CheckEmailForm extends Component
{
    public $email;
    public $password;
    public $userExists = false; 

    public function checkUser()
    {
        if ($this->userExists) {
            // Ako je userExists već true, pokrenite metodu za prijavu
            $this->login();
        } else {
            // Provjerite da li korisnik postoji
            $user = User::where('email', $this->email)->first();

            if ($user) {
                $this->userExists = true; // Postavite userExists na true da prikažete polje za lozinku
            } else {
                // Korisnik ne postoji, preusmjerite na registraciju
                return redirect()->route('register');
            }
        }
    }

    public function login()
    {
        // Ovdje dodajte logiku za prijavu korisnika
        $credentials = ['email' => $this->email, 'password' => $this->password];
    
        if (Auth::attempt($credentials)) {
            // Uspješna prijava, preusmjerite na željenu stranicu
            return redirect()->intended('dashboard');
        } else {
            // Prijavljivanje nije uspjelo, dodajte poruku o grešci
            $this->addError('password', 'Weitere Informationen finden Sie hier.');
        }
    }
    

    public function render()
    {
        return view('livewire.check-email-form');
    }
}
