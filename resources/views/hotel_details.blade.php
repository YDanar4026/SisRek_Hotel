<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $hotel->hotel_name }} - Detail Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-gray-900 text-white px-6 py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">JakartaHotels</h1>
            <a href="/" class="text-sm underline hover:text-blue-300">Kembali ke Home</a>
        </div>
    </header>

    <!-- Hotel Detail -->
    <section class="max-w-6xl mx-auto px-6 py-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $hotel->hotel_image) }}" alt="{{ $hotel->hotel_name }}" class="w-full h-64 object-cover">

            <div class="p-6">
                <h2 class="text-2xl font-bold">{{ $hotel->hotel_name }}</h2>
                <div class="text-sm text-gray-500 mt-1">{{ $hotel->hotel_name_link }}</div>
                <div class="mt-2 text-yellow-500">
                    @for ($i = 0; $i < floor($hotel->review_score); $i++)
                        ★
                    @endfor
                </div>
                <div class="text-orange-600 text-xl font-semibold mt-3">
                    Rp {{ number_format($hotel->hotel_price, 2, ',', '.') }}
                </div>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    {{ $hotel->review_score_title }} - {{ $hotel->review_score_text }}
                </p>

                <button class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Tambahkan ke Favorit
                </button>
            </div>
        </div>
    </section>

    <!-- Similar Hotels -->
<!-- Similar Hotels -->
<section class="max-w-6xl mx-auto px-6 py-8">
    <h3 class="text-xl font-bold mb-4">Hotel Mirip</h3>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($recommendations as $similar)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition block">
                <img src="{{ asset('img/hotel-placeholder.jpg') }}" alt="{{ $similar['hotel_name'] }}" class="w-full h-40 object-cover rounded-t-lg">
                <div class="p-4">
                    <h4 class="text-lg font-semibold truncate">{{ $similar['hotel_name'] }}</h4>
                    <div class="text-yellow-500 mt-1">
                        @for ($i = 0; $i < floor($similar['review_score']); $i++)
                            ★
                        @endfor
                    </div>
                    <div class="text-orange-600 font-bold mt-2 text-sm">
                        Rp {{ number_format($similar['hotel_price'] / 100, 2, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-500 mt-1">
                        Kemiripan: {{ number_format($similar['cosine_similarity'] * 100, 2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


</body>
</html>
