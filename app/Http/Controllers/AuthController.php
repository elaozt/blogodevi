<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate(['username' => ['required', 'string'], 'password' => ['required', 'string']]);
        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['username' => 'Kullanıcı adı veya şifre hatalı.'])->onlyInput('username');
        }
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[A-Za-z0-9_]+$/', 'unique:blog_user,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'username.regex' => 'Kullanıcı adı yalnızca harf, sayı ve alt çizgi içerebilir.',
            'username.unique' => 'Bu kullanıcı adı zaten alınmış.',
            'password.min' => 'Şifre en az 8 karakter olmalı.',
            'password.confirmed' => 'Şifre tekrarı eşleşmiyor.',
        ]);
        User::create(['username' => trim($data['username']), 'password' => $data['password'], 'role' => 'READER']);

        return redirect()->route('login')->with('message', 'Hesap oluşturuldu. Giriş yapabilirsin. Makale ekleme yalnızca blog sahibine açıktır.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
