<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register');
