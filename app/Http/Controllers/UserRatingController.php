<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserRatingController extends Controller
{
    public function showRatings()
    {
        $user = Auth::user(); // Dohvati trenutno prijavljenog korisnika
    
        if (!$user) {
            // Ako nema prijavljenog korisnika, preusmjeri na stranicu za prijavu ili neku drugu odgovarajuću stranicu
            return redirect()->route('login')->with('error', 'Morate biti prijavljeni da biste vidjeli ocjene.');
        }
    
        $ratings = $user->ratings()->paginate(10);
    
      
    
        // Sada možete proslijediti ove ocjene u vaš view
        return view('frontend.rating.show', compact('ratings'));
    }
    
}
