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

            @guest
                <a href="/login" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm font-medium">Login</a>
            @endguest

            @auth
            <div class="relative">
                <!-- Tombol Profil -->
                <button id="profileButton" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center hover:ring-2 ring-blue-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A9.004 9.004 0 0112 15c2.485 0 4.735.996 6.379 2.621M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="profileDropdown" class="absolute right-0 mt-2 w-40 bg-white shadow-md rounded-lg py-2 z-10 hidden">
                    <a href="{{ url('/favorites') . '?user_name=' . urlencode(Auth::user()->name) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Favorites
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
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
    <a href="/"
       class="px-3 py-1 rounded transition 
       {{ request()->is('/') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        Rating
    </a>

    <a href="{{ route('hotels.all') }}"
       class="px-3 py-1 rounded transition 
       {{ request()->routeIs('hotels.all') ? 'bg-blue-600 text-white' : 'hover:bg-blue-100' }}">
        All Hotels
    </a>
</div>

    </div>

    <!-- Hotel List -->
    <main class="max-w-7xl mx-auto px-6 py-6">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($hotels as $hotel)
                <a href="{{ route('hotel.detail', ['id' => $hotel['id']]) }}"
                   class="bg-white rounded-xl shadow-md transform transition duration-300 hover:shadow-lg hover:scale-[1.02] overflow-hidden relative block">
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

                    <form action="{{ route('add.favorite') }}" method="GET" class="absolute top-4 right-4">
                        @auth
                        <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="hotel_name" value="{{ $hotel['hotel_name'] }}">
                        @endauth
                        <button type="submit"
                                class="bg-white border border-gray-300 rounded-full p-2 hover:bg-red-100 hover:border-red-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 hover:text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.48 3.499a5.5 5.5 0 017.78 0c2.137 2.138 2.137 5.606 0 7.744L12 18.5l-7.26-7.257a5.5 5.5 0 017.74-7.744z"/>
                            </svg>
                        </button>
                    </form>
                </a>
            @endforeach
        </div>
    </main>
@php
    $currentPage = $hotels->currentPage();
    $lastPage = $hotels->lastPage();
    $start = max(1, $currentPage - 1);
    $end = min($lastPage, $currentPage + 1);
@endphp

<div class="mt-6 flex justify-center space-x-2">
    {{-- Previous Page --}}
    @if (!$hotels->onFirstPage())
        <a href="{{ $hotels->previousPageUrl() }}"
           class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
            &laquo; Prev
        </a>
    @endif

    {{-- Page 1 --}}
    <a href="{{ $hotels->url(1) }}"
       class="px-4 py-2 border rounded {{ $currentPage == 1 ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
        1
    </a>

    {{-- Left Ellipsis --}}
    @if ($start > 2)
        <span class="px-2 py-2 text-gray-500">...</span>
    @endif

    {{-- Page Numbers Around Current --}}
    @for ($i = $start; $i <= $end; $i++)
        @if ($i != 1 && $i != $lastPage)
            <a href="{{ $hotels->url($i) }}"
               class="px-4 py-2 border rounded {{ $currentPage == $i ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
                {{ $i }}
            </a>
        @endif
    @endfor

    {{-- Right Ellipsis --}}
    @if ($end < $lastPage - 1)
        <span class="px-2 py-2 text-gray-500">...</span>
    @endif

    {{-- Last Page --}}
    @if ($lastPage > 1)
        <a href="{{ $hotels->url($lastPage) }}"
           class="px-4 py-2 border rounded {{ $currentPage == $lastPage ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
            {{ $lastPage }}
        </a>
    @endif

    {{-- Next Page --}}
    @if ($hotels->hasMorePages())
        <a href="{{ $hotels->nextPageUrl() }}"
           class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
            Next &raquo;
        </a>
    @endif
</div>


    

    <!-- Script toggle dropdown -->
    <script>
        const profileBtn = document.getElementById('profileButton');
        const dropdown = document.getElementById('profileDropdown');

        profileBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!profileBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
