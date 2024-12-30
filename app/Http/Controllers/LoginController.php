<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'page'  => 'Back Office Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : (is_numeric($request->login)
                ? 'phone'
                : 'username');

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];


        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 1) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                Alert::error('Login Error', 'Pengguna tidak aktif atau pengguna tidak terdaftar.');
                return back();
            }
        }

        Alert::error('Login Error', 'Username atau password salah');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
