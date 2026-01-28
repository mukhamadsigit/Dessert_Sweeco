<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $roleType = $request->input('role_type');

            if ($user->status === 'banned') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda telah dinonaktifkan.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            // Admin/Staff path
            if ($roleType === 'admin') {
                if (in_array($user->role, ['owner', 'kasir', 'admin'])) {
                    return redirect()->intended('dashboard');
                } else {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Hanya Admin atau Staff yang dapat mengakses portal ini.',
                    ])->onlyInput('email');
                }
            }

            // User path
            if ($user->role === 'owner' || $user->role === 'kasir' || $user->role === 'admin') {
                return redirect()->intended('dashboard');
            }

            return redirect()->intended('/user');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
