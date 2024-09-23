<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and their user_type is admin (assuming 1 is for admin)
        if (Auth::check() && Auth::user()->user_type == 0) {
            return $next($request); // Allow the request to proceed
        }

        // If the user is not an admin, redirect to a different page or abort
        return redirect('/')->with('error', 'You are not authorized to access this page.');
    }
}
