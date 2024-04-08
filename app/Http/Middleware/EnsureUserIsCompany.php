<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == 'company') {
            return $next($request);
        }

        // Preusmjeravanje na početnu stranicu ako korisnik nije 'company'
        return redirect('/');
    }
}
