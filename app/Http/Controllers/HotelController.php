<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
        // dd($hotels);
        return view('home', compact('hotels'));
    }

     public function allHotel(Request $request)
    {
        $page = $request->input('page', 1); // default ke halaman 1
        $perPage = 6; // jumlah hotel per halaman

        // fetch django api hehehe
        $response = Http::get('http://127.0.0.1:7000/core/hotels'); // sesuaikan URL sesuai API Django-mu
      
        $hotels = $response->json()['hotels'] ?? [];

        
        // Manual Pagination itung itungan
        $offset = ($page - 1) * $perPage;
        $itemsForCurrentPage = array_slice($hotels, $offset, $perPage);

        $paginator = new LengthAwarePaginator(
            $itemsForCurrentPage,
            count($hotels),
            $perPage,
            $page,
            ['path' => url('/hotels')]
        );

        return view('hotel_all', ['hotels' => $paginator]);
    }

    public function show($id)
    {
        $response = Http::get('http://127.0.0.1:7000/core/hotel-info/' . $id);
        $data = $response->json();

        $hotel = (object) $data['hotel'];

        // Ambil hotel mirip berdasarkan nama
        $response_content_based = Http::get('http://127.0.0.1:7000/contentBased/', [
            'hotel_name' => $hotel->hotel_name,
            'top_n' => 3
        ]);

        $recommendations = $response_content_based->json()['recommendations'] ?? [];
        // dd($recommendations);
        return view('hotel_details', compact('hotel', 'recommendations'));
    }



public function addFavorite(Request $request){
    // Ambil user_name dan hotel_name dari query parameter GET
    $userName = $request->query('user_name');
    $hotelName = $request->query('hotel_name');

    if (!$userName || !$hotelName) {
        return redirect()->route('favorites.index')
                         ->with('error', 'Parameter "user_name" dan "hotel_name" wajib diisi.');
    }

    // URL endpoint Django
    $djangoUrl = 'http://127.0.0.1:7000/collaborativeBased/add-favorites';

    try {
        $response = Http::get($djangoUrl, [
            'user_name' => $userName,
            'hotel_name' => $hotelName,
        ]);

        if ($response->successful()) {
            return redirect()->route('favorites.index', ['user_name' => $userName])
                             ->with('success', 'Hotel berhasil ditambahkan ke favorit!');
        } else {
            return redirect()->route('favorites.index', ['user_name' => $userName])
                             ->with('error', 'Gagal menambahkan ke favorit. Server Django mengembalikan error.');
        }
    } catch (\Exception $e) {
        return redirect()->route('favorites.index', ['username' => $userName])
                         ->with('error', 'Terjadi kesalahan saat menghubungi server rekomendasi.');
    }
}


 public function showFavorites(Request $request){
        $userName = $request->query('user_name');
  

        if (!$userName) {
            return redirect()->back()->withErrors(['user_name' => 'Parameter user_name wajib diisi']);
        }

        // URL endpoint Django untuk list favorites
        $djangoUrl = 'http://127.0.0.1:7000/collaborativeBased/list-favorites';

        // Request ke Django API pakai query param user_name
        $response = Http::get($djangoUrl, [
            'user_name' => $userName,
        ]);

        if ($response->failed()) {
            return redirect()->back()->withErrors(['api' => 'Gagal mengambil data favorite dari server.']);
        }

        $data = $response->json();

        // Kirim data favorite ke view
        return view('favorite_list', [
            'user' => $data['user'] ?? null,
            'favorites' => $data['favorites'] ?? [],
            'user_name' => $userName,
        ]);
}


    public function showRecommendations(Request $request){
    $user_name = $request->query('username');

    // dd($user_name);
    if (!$user_name) {
        return back()->with('error', 'Silakan masukkan nama user terlebih dahulu.');
    }

    $response = Http::get('http://127.0.0.1:7000/collaborativeBased/', [ 
        'user_name' => $user_name,
        'top_n' => 6
    ]);
  

    if ($response->failed()) {
        return view('hotels.recommendations', [
            'error' => $response->json()['message'] ?? 'Terjadi kesalahan.',
            'user_name' => $user_name,
            'hotels' => []
        ]);
    }

    $data = $response->json();
    // dd($data['recommendations']);
    return view('hotel_collaborative', [
        'hotels' => $data['recommendations'],
        'user_name' => $data['user_name'],
        'similar_user' => $data['similar_users'][0] ?? null
    ]);
}


}
