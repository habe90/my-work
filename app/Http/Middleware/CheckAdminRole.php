<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
        {
            // Provjerite da li je korisnik autentificiran i ima ulogu 'admin'
            if (auth()->check() && auth()->user()->role == 'admin') {
                return $next($request);
            }

            // Ako korisnik nema ulogu 'admin', preusmjerite ga na početnu stranicu ili prikažite poruku o grešci
            return redirect('/')->with('error', 'Nemate dozvolu za pristup ovoj stranici.');
        }

}
