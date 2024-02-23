<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowLoginForm extends Component
{
    public $email = '';
    public $password = '';

    public function login()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended('dashboard');  // Preusmjeravanje na željenu stranicu nakon prijave
        }

        $this->addError('email', trans('auth.failed'));
    }

    public function render()
    {
        return view('livewire.show-login-form');
    }
}

