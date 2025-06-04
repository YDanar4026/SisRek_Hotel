<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JakartaHotels - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-gray-900 text-white px-6 py-3 flex justify-between items-center">
        <h1 class="text-xl font-bold">Home</h1>
    </header>

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="flex gap-6 items-center">
            <h2 class="text-sky-500 text-xl font-extrabold">JakartaHotels</h2>
            <div class="flex border rounded px-2 py-1 items-center">
                <span class="text-gray-400 mr-2">Kategori</span>
                <input type="text" placeholder="Search" class="text-sm outline-none">
            </div>
        </div>
        <a href="#" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Login</a>
    </nav>

    <!-- Filters -->
    <div class="bg-white px-6 py-2 flex gap-8 font-semibold">
        <button class="hover:text-blue-600">Harga</button>
        <button class="hover:text-blue-600">Rating</button>
        <button class="hover:text-blue-600">Rekomendasi</button>
    </div>

    <!-- Hotel list -->
    <main class="px-6 py-4">
    <div class="space-y-4">
        @foreach($hotels as $hotel)
            <div class="bg-white rounded-lg shadow flex overflow-hidden">
                <!-- Gambar hotel -->
                <img src="{{ asset($hotel['image']) }}" alt="Hotel" class="w-40 object-cover"/>

                <!-- Info hotel -->
                <div class="flex-1 p-4 relative">
                    <h3 class="text-lg font-bold">{{ $hotel['name'] }}</h3>
                    <div class="text-yellow-500 mt-1">
                        @for ($i = 0; $i < $hotel['rating']; $i++)
                            ★
                        @endfor
                    </div>
                    <div class="text-green-600 text-sm mt-1">📍 {{ $hotel['location'] }}</div>
                    <div class="absolute bottom-4 right-4 text-orange-600 font-bold">
                        Rp {{ number_format($hotel['price'], 2, ',', '.') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </main>

</body>
</html>
