<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
// use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
// use Illuminate\View\View;


class registerController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 2,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('order');
    }

    public function login(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed, regenerate session to prevent session fixation
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->user_type == 0 || $user->user_type == 1) {
                return redirect()->route('staffPage', ['user' => $user->id]); // Redirect to staff dashboard for user types 0 and 1
            }

            // Redirect to the intended page or a default page after successful login
            return redirect()->intended('order');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }


    public function logout(): RedirectResponse
    {
        if (Auth::check()) {
            // If the user is logged in, proceed with logging them out
            Auth::logout();
    
            // Redirect to the desired page after logging out
            return redirect()->route('firstPage')->with('message', 'You have been successfully logged out.');
        } else {
            // If no user is logged in, redirect them to the login page
            return redirect()->route('reg.log');
        }
    }
}
