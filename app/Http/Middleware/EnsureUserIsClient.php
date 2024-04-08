<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsClient
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == 'client') {
            return $next($request);
        }

        // Preusmjeravanje na početnu stranicu ako korisnik nije 'user'
        return redirect('/');
    }
}
