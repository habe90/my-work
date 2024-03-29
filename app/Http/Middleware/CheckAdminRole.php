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
        // Überprüfen, ob der Benutzer authentifiziert ist
        if (!auth()->check()) {
            return redirect('/')->with('error', 'Sie sind nicht angemeldet.');
        }
    
        // Überprüfen, ob der Benutzer die Rolle 'Admin' hat
        if (auth()->user()->roles->contains('title', 'Admin')) {
            return $next($request);
        }
    
        // Wenn der Benutzer nicht die Rolle 'Admin' hat, umleiten zur Startseite mit einer Fehlermeldung
        return redirect('/')->with('error', 'Sie haben keine Berechtigung, diese Seite zu betreten.');
    }
    

}
