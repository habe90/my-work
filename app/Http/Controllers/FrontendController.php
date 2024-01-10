<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPage;
use App\Models\User;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function showMenu()
{
    
    $menuPages = ContentPage::whereHas('category', function ($query) {
        $query->where('name', 'Menu'); // 'name' je kolona u tabeli content_categories
    })->where('active', 1)->get();

    return view('frontend.index', compact('menuPages'));
}

    public function showBySlug($slug)
    {
        $contentPage = ContentPage::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.show', compact('contentPage'));
    }

    public function ClientLogin(){
        return view('frontend.ClientLogin.login');
    }

    public function checkLogin(Request $request) {
        $email = $request->input('email'); // Koristi input metodu za pristup podacima iz zahtjeva
        $user = User::where('email', $email)->first();
        
        if($user) {
            // Korisnik postoji
            session(['user_email' => $email]);
            return response()->json(['userExists' => true]);
        } else {
            // Korisnik ne postoji
            return response()->json(['userExists' => false]);
        }
    }

    public function showLoginOptions() {
        return view('frontend.ClientLogin.loginoptions'); // Pretpostavka da je 'loginoptions' ime vašeg Blade fajla
    }
    
    
    


}
