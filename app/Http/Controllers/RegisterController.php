<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validasi sederhana (contoh)
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'fullname' => 'required',
            'birthdate' => 'required|date',
        ]);

        // Simulasi penyimpanan
        // User::create([...]);

        return redirect('/register')->with('success', 'Registrasi berhasil!');
    }
}