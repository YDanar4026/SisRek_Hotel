<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $hotel->name }} - Detail Hotel</title>
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
            <img src="{{ asset($hotel->image) }}" alt="{{ $hotel->name }}" class="w-full h-64 object-cover">

            <div class="p-6">
                <h2 class="text-2xl font-bold">{{ $hotel->name }}</h2>
                <div class="text-sm text-gray-500 mt-1">{{ $hotel->location }}</div>
                <div class="mt-2 text-yellow-500">
                    @for ($i = 0; $i < $hotel->rating; $i++)
                        ★
                    @endfor
                </div>
                <div class="text-orange-600 text-xl font-semibold mt-3">
                    Rp {{ number_format($hotel->price, 2, ',', '.') }}
                </div>

                <p class="mt-4 text-gray-700 leading-relaxed">
                    {{ $hotel->description ?? 'Deskripsi belum tersedia untuk hotel ini.' }}
                </p>

                <button class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Tambahkan ke Favorit
                </button>
            </div>
        </div>
    </section>

    <!-- Similar Hotels -->
    <section class="max-w-6xl mx-auto px-6 py-8">
        <h3 class="text-xl font-bold mb-4">Hotel Mirip</h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($similarHotels as $similar)
                <a href="{{ route('hotel.show', $similar->id) }}" class="bg-white rounded-lg shadow hover:shadow-md transition block">
                    <img src="{{ asset($similar->image) }}" alt="{{ $similar->name }}" class="w-full h-40 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold truncate">{{ $similar->name }}</h4>
                        <div class="text-sm text-gray-500 mt-1">{{ $similar->location }}</div>
                        <div class="text-yellow-500 mt-1">
                            @for ($i = 0; $i < $similar->rating; $i++)
                                ★
                            @endfor
                        </div>
                        <div class="text-orange-600 font-bold mt-2 text-sm">
                            Rp {{ number_format($similar->price, 2, ',', '.') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

</body>
</html>
