<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = [
            [
                'name' => 'Merbabu Hotel',
                'location' => '0',
                'rating' => 3,
                'price' => 305000,
                'image' => 'https://via.placeholder.com/150x100',
            ],
            // Tambahkan hotel lain jika perlu
        ];

        return view('home', compact('hotels'));
    }
}
