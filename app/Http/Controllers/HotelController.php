<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        // $hotels = [
        //     [
        //         'name' => 'Mövenpick Hotel',
        //         'location' => 'Jakarta City Centre',
        //         'rating' => 4,
        //         'price' => 885000,
        //         'image' => 'images/Mövenpick Hotel.jpg',
        //     ],
        //     [
        //         'name' => 'Jayakarta Hotel',
        //         'location' => 'Jakarta Barat',
        //         'rating' => 4,
        //         'price' => 750000,
        //         'image' => 'images/Jayakarta Hotel.jpg',
        //     ],
        //     [
        //         'name' => 'Hotel Mulia Senayan',
        //         'location' => 'Senayan, Jakarta Pusat',
        //         'rating' => 5,
        //         'price' => 1400000,
        //         'image' => 'images/mulia.jpg',
        //     ],
        //     [
        //         'name' => 'Aston Pluit Hotel',
        //         'location' => 'Pluit, Jakarta Utara',
        //         'rating' => 4,
        //         'price' => 850000,
        //         'image' => 'images/aston.jpg',
        //     ],
        //     [
        //         'name' => 'Harris Vertu Harmoni',
        //         'location' => 'Harmoni, Jakarta Pusat',
        //         'rating' => 4,
        //         'price' => 920000,
        //         'image' => 'images/harris.jpg',
        //     ],
        //     [
        //         'name' => 'Pullman Jakarta Central Park',
        //         'location' => 'Tanjung Duren, Jakarta Barat',
        //         'rating' => 5,
        //         'price' => 1350000,
        //         'image' => 'images/pullman.jpg',
        //     ],
        //     [
        //         'name' => 'Ibis Styles Jakarta Gajah Mada',
        //         'location' => 'Gajah Mada, Jakarta Barat',
        //         'rating' => 3,
        //         'price' => 550000,
        //         'image' => 'images/ibis.jpg',
        //     ],
        //     [
        //         'name' => 'Grand Mercure Kemayoran',
        //         'location' => 'Kemayoran, Jakarta Pusat',
        //         'rating' => 4,
        //         'price' => 980000,
        //         'image' => 'images/mercure.jpg',
        //     ],
        //     [
        //         'name' => 'Hotel Neo Mangga Dua',
        //         'location' => 'Mangga Dua, Jakarta Utara',
        //         'rating' => 3,
        //         'price' => 600000,
        //         'image' => 'images/neo.jpg',
        //     ],
        //     [
        //         'name' => 'Swiss-Belhotel Mangga Besar',
        //         'location' => 'Mangga Besar, Jakarta Barat',
        //         'rating' => 4,
        //         'price' => 870000,
        //         'image' => 'images/swissbel.jpg',
        //     ],

        // ];
        $response = Http::get('http://127.0.0.1:7000/ratingBased');
        $hotels = $response->json();
        return view('home', compact('hotels'));
    }
}
