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
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('order');
    }

    public function logout(): RedirectResponse
    {
        if (Auth::check()) {
            // If the user is logged in, proceed with logging them out
            Auth::logout();
    
            // Redirect to the desired page after logging out
            return redirect()->route('firstPage');
        } else {
            // If no user is logged in, redirect them to the login page
            return redirect()->route('reg.log');
        }
    }
}
