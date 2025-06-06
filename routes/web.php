<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;
Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
})->name("login-view");
Route::post('/handle-login', [RegisterController::class, 'login'])->name('login');
Route::post('/handle-logout', [RegisterController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/', [HotelController::class, 'index'])->name('home');
Route::get('/hotels', [HotelController::class, 'allHotel'])->name('hotels.all');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotel.detail');

Route::get('/recommendation_collaborative', [HotelController::class, 'showRecommendations'])->name('hotels.collaborative');

Route::get('/favorites', [HotelController::class, 'showFavorites'])->name('favorites.index');
Route::get('/add-favorite', [HotelController::class, 'addFavorite'])->name("add.favorite");

