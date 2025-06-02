<?php

use App\Http\Controllers\RegisterController;

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register');
