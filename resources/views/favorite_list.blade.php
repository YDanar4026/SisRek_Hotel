<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Favorite Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6 min-h-screen flex flex-col">

    <!-- Flash Message (Success or Error) -->
    @if (session('success'))
        <div id="flash-message" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="flash-message" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('error') }}
        </div>
    @endif

    <!-- Header -->
    <header class="bg-white shadow-md rounded-lg mb-8 max-w-7xl mx-auto px-6 py-4 flex items-start justify-between">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">JakartaHotels - Favorite List</h1>
    </header>

    <!-- Tombol Kembali -->
    <button
        onclick="window.history.back()"
        class="fixed top-4 right-4 inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-3 py-1 rounded-lg shadow transition text-sm z-50"
        aria-label="Kembali"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </button>

    <!-- Konten Utama -->
    <main role="main" class="max-w-7xl mx-auto flex-grow">

        @if (!empty($user))
            <h2 class="text-xl mb-6 text-gray-800">User: <span class="font-semibold">{{ $user }}</span></h2>

            @if (!empty($favorites) && count($favorites) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($favorites as $fav)
                        <div
                            tabindex="0"
                            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <img
                                src="{{ $fav['hotel_image'] ?? 'https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=400&w=600' }}"
                                alt="Hotel {{ $fav['hotel_name'] ?? 'No Name' }}"
                                class="w-full h-52 object-cover"
                                loading="lazy"
                            />
                            <div class="p-5">
                                <h3 class="text-lg font-semibold text-gray-900 truncate hover:underline" title="{{ $fav['hotel_name'] }}">
                                    {{ $fav['hotel_name'] ?? 'Nama Hotel Tidak Tersedia' }}
                                </h3>

                                <div class="mt-2 flex items-center gap-3">
                                    <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $fav['review_score'] ?? '-' }}
                                    </span>
                                    <span class="text-sm text-gray-600">
                                        {{ $fav['review_score_title'] ?? 'No rating' }}
                                    </span>
                                </div>

                                <p class="text-gray-400 text-xs mt-1">
                                    {{ $fav['review_score_text'] ?? '' }}
                                </p>

                                <p class="mt-4 text-orange-600 font-bold text-lg">
                                    Rp {{ isset($fav['hotel_price']) ? number_format($fav['hotel_price'], 0, ',', '.') : '-' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center mt-10 text-lg">User ini belum memiliki hotel favorit.</p>
            @endif

        @elseif(!empty($user_name))
            <p class="text-red-600 text-center mt-10 text-lg">Tidak ditemukan data untuk user: {{ $user_name }}</p>
        @else
            <p class="text-gray-600 text-center mt-10 text-lg">Silakan pilih user untuk melihat daftar favorit hotel.</p>
        @endif

    </main>

    <!-- Footer -->
    <footer class="max-w-7xl mx-auto py-8 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} JakartaHotels. All rights reserved.
    </footer>

    <!-- Script Auto-hide Flash Message -->
    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = 0;
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);
    </script>
    
</body>
</html>
