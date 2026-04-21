<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // tampilkan form login
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('jurusan.index');
        }

        return view('auth.login');
    }

    // proses login
    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('jurusan.index');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // Cek apakah email terdaftar
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->withInput()->with('error', 'Email tidak terdaftar');
        }
        
        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('jurusan.index')->with('success', 'Login berhasil');
        }

        return back()->withInput()->with('error', 'Password salah');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
