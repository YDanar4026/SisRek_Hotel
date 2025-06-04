<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JakartaHotels - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-gray-900 text-white px-6 py-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">JakartaHotels</h1>
            <a href="#" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm font-medium">Login</a>
        </div>
    </header>

    <!-- Navbar -->
    <nav class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-col md:flex-row gap-4 md:items-center w-full md:w-auto">
                <h2 class="text-sky-600 text-2xl font-bold">Temukan Hotel Terbaik</h2>
                <div class="flex items-center w-full md:w-80 border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus-within:ring-2 ring-blue-300">
                    <input type="text" placeholder="Cari hotel berdasarkan lokasi atau nama..." class="bg-transparent w-full focus:outline-none text-sm placeholder-gray-400">
                </div>
            </div>
        </div>
    </nav>

    <!-- Filters -->
    <div class="bg-white border-b py-3">
        <div class="max-w-7xl mx-auto px-6 flex gap-4 text-gray-700 font-semibold text-sm">
            <button class="px-3 py-1 rounded hover:bg-blue-100 transition">Harga</button>
            <button class="px-3 py-1 rounded hover:bg-blue-100 transition">Rating</button>
            <button class="px-3 py-1 rounded hover:bg-blue-100 transition">Rekomendasi</button>
        </div>
    </div>

    <!-- Hotel List -->
    <main class="max-w-7xl mx-auto px-6 py-6">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($hotels as $hotel)
                    <a href="{{ route('hotel.detail', ['id' => $hotel['id']]) }}"
                class="bg-white rounded-xl shadow-md transform transition duration-300 hover:shadow-lg hover:scale-[1.02] overflow-hidden relative group block">
                <img
                    src="{{ $hotel['hotel_image'] }}"
                    alt="{{ $hotel['hotel_name'] }}"
                    class="w-full h-48 object-cover"
                    onerror="this.onerror=null;this.src='https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=400&w=600';"
                />

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate hover:underline">
                        {{ $hotel['hotel_name'] }}
                    </h3>

                    <div class="mt-1 flex items-center gap-2">
                        <span class="text-white bg-green-600 text-xs font-semibold px-2 py-0.5 rounded">
                            {{ $hotel['review_score'] }}
                        </span>
                        <span class="text-sm text-gray-600">{{ $hotel['review_score_title'] }}</span>
                    </div>

                    <div class="text-gray-400 text-xs mt-1">{{ $hotel['review_score_text'] }}</div>

                    <div class="text-orange-600 font-bold text-base mt-2">
                        Rp {{ number_format($hotel['hotel_price'], 0, ',', '.') }}
                    </div>
                </div>

                <button class="absolute top-4 right-4 bg-white border border-gray-300 rounded-full p-2 hover:bg-red-100 hover:border-red-300 transition group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 hover:text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a5.5 5.5 0 017.78 0c2.137 2.138 2.137 5.606 0 7.744L12 18.5l-7.26-7.257a5.5 5.5 0 017.74-7.744z"/>
                    </svg>
                </button>
                </a>

            @endforeach

        </div>
    </main>

</body>
</html>
