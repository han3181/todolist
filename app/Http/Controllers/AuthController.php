<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Pastikan ada 'confirmed' di sini
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password), // Hash password sebelum menyimpannya
        ]);

        // Setelah registrasi, Anda bisa mengarahkan pengguna ke halaman login atau langsung login
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki view 'auth.login'
    }

    // Metode untuk proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            // Jika berhasil, redirect ke halaman yang diinginkan
            return redirect()->intended('tasks'); // Ganti 'tasks' dengan rute yang sesuai
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['login' => 'Invalid credentials'])->withInput();
    }
}
