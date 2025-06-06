<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    try {
       
        // Simpan ke database Laravel
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
 


        $response = Http::timeout(5)->get('http://localhost:7000/core/add-user/', [
            'full_name' => $request->name,
            'email' => $request->email,
        ]);

        // Cek respon Django
        if ($response->successful()) {
            return redirect('/register')->with('success', 'Registrasi berhasil');
        } 

    } catch (\Exception $e) {
        return redirect('/register')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    


        public function login(Request $request){
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
     
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // mencegah session fixation

            return redirect()->intended('/'); 
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}