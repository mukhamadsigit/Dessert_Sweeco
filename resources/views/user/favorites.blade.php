<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Favorit Saya - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white min-h-screen border-r border-[#F1F5F9] hidden lg:block sticky top-0 h-screen overflow-y-auto font-medium z-30 flex-shrink-0">
            <div class="px-6 py-8">
                <div class="text-2xl font-bold tracking-tight mb-10 text-[#334155]">Sweeco <br><span class="text-sm font-normal text-[#F43F5E] tracking-widest bg-clip-text text-transparent bg-gradient-to-r from-rose-500 to-orange-400">USER DASHBOARD</span></div>
                
                <nav class="space-y-2">
                    <a href="{{ route('user.index') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- New Favorites Link -->
                    <a href="{{ route('user.favorites') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl bg-[#FFF1F2] text-[#E11D48] font-bold shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Favorit</span>
                    </a>
                    
                    <a href="{{ route('user.orders') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Pesanan Anda</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 p-3.5 rounded-2xl text-[#94A3B8] hover:bg-rose-50 hover:text-rose-500 transition mt-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1H3v1h10v1a2 2 0 012 2" />
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 lg:p-12 bg-[#F8FAFC] min-h-screen">
            <!-- Header -->
            <header class="flex justify-between items-center mb-12">
                <div>
                     <h1 class="text-3xl font-extrabold text-[#334155] mb-2">Menu Favorit</h1>
                    <p class="text-[#64748B] font-medium">Koleksi dessert manis kesukaanmu</p>
                </div>
                
                <a href="{{ route('user.index') }}" class="w-12 h-12 bg-white rounded-2xl border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F1F5F9] transition text-[#64748B] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </header>

            <!-- Favorites Grid -->
            @if($favorites->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favorites as $menu)
                <div class="bg-white rounded-[32px] p-4 border border-[#F1F5F9] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl transition duration-300 relative group flex flex-col h-full">
                    <div class="w-full h-48 bg-[#F8FAFC] rounded-2xl overflow-hidden mb-4 relative">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-rose-500 shadow-sm custom-font">
                            {{ $menu->category }}
                        </span>
                    </div>
                    
                    <div class="flex-1 flex flex-col">
                        <h4 class="font-bold text-[#1E293B] text-lg mb-1">{{ $menu->name }}</h4>
                        <p class="text-rose-500 font-extrabold text-lg mb-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        
                        <div class="mt-auto flex gap-2">
                             <button onclick="toggleFavorite({{ $menu->id }}, this)" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <button class="flex-1 rounded-xl bg-[#1E293B] text-white font-bold text-sm hover:bg-[#334155] transition py-2">
                                Pesan Lagi
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-[40px] p-20 text-center border border-dashed border-[#E2E8F0] opacity-80">
                <div class="w-24 h-24 bg-[#F1F5F9] rounded-full flex items-center justify-center mx-auto mb-6 text-[#94A3B8]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-rose-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#334155] mb-2">Belum ada favorit</h3>
                <p class="text-[#64748B]">Klik ikon hati untuk menyimpan menu kesukaanmu!</p>
                <a href="{{ route('user.index') }}" class="inline-block mt-6 px-6 py-3 bg-rose-500 text-white rounded-xl font-bold hover:bg-rose-600 transition shadow-lg shadow-rose-500/20">
                    Cari Menu
                </a>
            </div>
            @endif
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Configure Axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function toggleFavorite(id, btn) {
            axios.post(`/user/favorites/${id}`)
                .then(response => {
                    // Just reload or remove element slightly better
                    location.reload(); 
                })
                .catch(error => {
                    alert('Terjadi kesalahan');
                });
        }
    </script>
</body>
</html>
