<?php

namespace App\Http\Middleware;

use App\Models\ImConversation;
use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\JobController;

class ShareUnreadConversations
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            view()->share('unreadConversations', ImConversation::getUnreadConversations());
        }

        return $next($request);
    }
}
