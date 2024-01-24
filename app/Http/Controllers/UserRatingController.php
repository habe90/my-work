<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserRatingController extends Controller
{
    public function showRatings()
    {
        $user = Auth::user(); // Dohvati trenutno prijavljenog korisnika
        $ratings = $user->ratings()->paginate(10);
    
        // Sada možete proslijediti ove recenzije u vaš view
        return view('frontend.rating.show', compact('ratings'));
    }
}
