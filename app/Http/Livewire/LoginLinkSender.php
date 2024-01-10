<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\LoginLinkEmail;

class LoginLinkSender extends Component
{
    public $email;
    public $showPasswordForm = false;
    public $password;

    public function mount($email)
    {
        $this->email = $email;
    }

    public function togglePasswordForm()
    {
        $this->showPasswordForm = !$this->showPasswordForm;
    }

    public function loginWithPassword()
    {
        // Ovdje implementirajte logiku za prijavu pomoću lozinke
        // Ovo može uključivati provjeru lozinke i autentifikaciju korisnika
    }

    public function sendLoginLink()
    {
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            session()->flash('error', 'Nismo mogli pronaći vaš korisnički račun.');
            return;
        }

        $token = Str::random(60);
        $user->login_token = $token;
        $user->token_expires_at = now()->addMinutes(15);
        $user->save();

        $loginLink = url('/login/verify', $token);
        Mail::to($user->email)->send(new LoginLinkEmail($loginLink));

        session()->flash('message', 'Link za prijavu poslan na e-mail.');
    }

    public function render()
    {
        return view('livewire.login-link-sender');
    }
}
