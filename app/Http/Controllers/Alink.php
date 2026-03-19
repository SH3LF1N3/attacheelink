<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Alink extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role'     => ['required', 'in:student,company'],
            'uname'    => ['required', 'string', 'max:255', 'unique:users,uname'],
            'fname'    => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'phone'    => ['required', 'string', 'max:20'],
            'gender'   => ['nullable', 'in:Male,Female'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        User::create([
            'role'     => $request->role,
            'uname'    => $request->uname,
            'fname'    => $request->fname,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'gender'   => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login with success flash — do NOT auto-login
        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please sign in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}