<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        // Check if user is already logged in as admin, redirect to admin dashboard
        // if (Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.dashboard');
        // }

        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('/admin');
            }
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->withErrors(['email' => 'You do not have administrative access.']);
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user from the default guard

        $request->session()->invalidate(); // Invalidate the current session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('admin.login')->with('status', 'You have been logged out successfully.');
    }
}
