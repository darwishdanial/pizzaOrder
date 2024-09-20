<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

       // Check if the user is type 0 or 1 and prevent them from accessing restricted routes
       if ($user && ($user->user_type === 0 || $user->user_type === 1)) {
            // Avoid redirecting if the current request is already for the staff dashboard
            if (!$request->is('staff-dashboard')) {
                return redirect()->route('staffPage', ['user' => $user->id])->withErrors('Access Denied');
            }
        }

        return $next($request);
    }
}
