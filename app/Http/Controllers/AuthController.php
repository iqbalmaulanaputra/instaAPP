<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $isAuthenticated = Auth::attempt([
            $field => $credentials['login'],
            'password' => $credentials['password'],
        ], true);

        if (! $isAuthenticated) {
            return response()->json([
                'message' => 'Username/email atau kata sandi salah.',
            ], 422);
        }

        $request->session()->regenerate();
        $request->session()->flash('success', 'Berhasil masuk. Selamat datang kembali, ' . Auth::user()->name . '!');

        return response()->json([
            'message' => 'Berhasil masuk.',
            'redirect' => url('/'),
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        $request->session()->flash('success', 'Akun berhasil dibuat. Selamat bergabung, ' . $user->name . '!');

        return response()->json([
            'message' => 'Akun berhasil dibuat.',
            'redirect' => url('/'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('success', 'Berhasil keluar. Sampai jumpa lagi!');

        return response()->json([
            'message' => 'Berhasil keluar.',
            'redirect' => url('/'),
        ]);
    }
}
