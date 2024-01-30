<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPage;
use App\Models\User;
use App\Models\MyWorkReview;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\LoginLinkEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {

        $reviews = MyWorkReview::all();

        

        return view('frontend.index', compact('reviews'));
    }

    public function showMenu()
    {
        $menuPages = ContentPage::whereHas('category', function ($query) {
            $query->where('name', 'Menu'); // 'name' je kolona u tabeli content_categories
        })
            ->where('active', 1)
            ->get();

        return view('frontend.index', compact('menuPages'));
    }

    public function showBySlug($slug)
    {
        $contentPage = ContentPage::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.show', compact('contentPage'));
    }

    public function ClientLogin()
    {
        return view('frontend.ClientLogin.login');
    }

    public function checkLogin(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            // Korisnik postoji
            session(['user_email' => $email]);
            return response()->json(['userExists' => true]);
        } else {
            // Korisnik ne postoji
            return response()->json(['userExists' => false]);
        }
    }

    public function showLoginOptions()
    {
        return view('frontend.ClientLogin.loginoptions', ['user_email' => session('user_email')]); 
    }

    public function sendLoginLink(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            // Generišite token i sačuvajte ga uz korisnika s vremenom isteka
            $token = Str::random(60);
            $user->login_token = $token;
            $user->token_expires_at = Carbon::now()->addMinutes(15);
            $user->save();

            // Pošaljite e-mail s linkom za prijavu
            $loginLink = url('/login/verify', $token);
            Mail::to($user->email)->send(new LoginLinkEmail($loginLink));

            // Povratni odgovor ili prikazivanje view-a s obavijesti
            return view('auth.verify_email', ['email' => $email]);
        } else {
            return back()->with('error', 'Nismo mogli pronaći vaš korisnički račun.');
        }
    }

    // Metoda koja se poziva kada korisnik klikne na link za prijavu
    public function verifyLoginLink($token)
    {
        $user = User::where('login_token', $token)
            ->where('token_expires_at', '>', Carbon::now())
            ->first();

        if ($user) {
            // Prijavite korisnika
            Auth::login($user);

            // Očistite token nakon uspješne prijave
            $user->login_token = null;
            $user->token_expires_at = null;
            $user->save();

            // Preusmjerite korisnika gdje želite
            return redirect()->intended('dashboard');
        } else {
            return back()->with('error', 'The login link is invalid or has expired.');
        }
    }

    public function howtowork()
    {
        return view('frontend.howtowork'); 
    }
}
