<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HotelController;

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/', [HotelController::class, 'index'])->name('home');