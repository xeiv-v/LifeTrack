<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // harus ada password_confirmation
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // ✅ hash password
        ]);

        return redirect()->route('login.form')->with('success', 'Akun berhasil dibuat, silakan login!');
    }
}
