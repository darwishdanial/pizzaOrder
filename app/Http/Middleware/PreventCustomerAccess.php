<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class PreventCustomerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        // If the user is not a staff or admin (user_type 0 or 1), redirect them
        if ($user && $user->user_type== 2) {
            return redirect()->route('firstPage')->with('error', 'You are not authorized to access this page.');
        }
        return $next($request);
    }
}
