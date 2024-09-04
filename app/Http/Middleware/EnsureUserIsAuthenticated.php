<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Check if the request is an AJAX request
            if ($request->ajax()) {
                // For AJAX requests, return a JSON response with a 401 status
                return response()->json(['redirect' => route('reg.log')], 401);
            }

            // For non-AJAX requests, redirect to the login page
            return redirect()->route('reg.log');
        }

        return $next($request);
    }
}

