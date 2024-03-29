<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\LoginLinkEmail;
use Illuminate\Support\Facades\Auth;

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
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Uspješna prijava, provjera tipa korisnika
            $user = Auth::user();
            $user->update(['last_activity' => now()]);
            if ($user->user_type === 'client') {
                // Ako je korisnik tipa 'client', preusmjeri na klijentski dashboard
                return redirect()->intended(route('user.dashboard'));
            } else {
                // Ako nije, preusmjeri na drugi dashboard ili početnu stranicu
                return redirect()->intended('/company-dashboard');
            }
        } else {
            // Neuspješna prijava, prikaz poruke o grešci
            session()->flash('error', 'Incorrect email or password.');
        }
    }

    public function sendLoginLink()
    {
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            session()->flash('error', 'We could not find your account.');
            return;
        }

        $token = Str::random(60);
        $user->login_token = $token;
        $user->token_expires_at = now()->addMinutes(15);
        $user->save();

        $loginLink = url('/login/verify', $token);
        Mail::to($user->email)->send(new LoginLinkEmail($loginLink));

        session()->flash('message', 'Login link sent to e-mail.');
    }

    public function render()
    {
        return view('livewire.login-link-sender');
    }
}
