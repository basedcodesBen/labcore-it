<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle the login attempt.
     */

     public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Redirect based on user role
            $role = Auth::user()->role; // Assuming you have a 'role' field in the users table
            return redirect()->route($role . '.dashboard');  // Redirects to role-based dashboard
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * Handle the logout logic.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
