<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrackUserSession
{
    public function handle(Request $request, Closure $next)
    {
        // Always update the current page URL in session
        Session::put('current_page', url()->current());

        return $next($request);
    }
}
