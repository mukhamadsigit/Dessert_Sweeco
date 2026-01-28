<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hot Today's Menu - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-font { font-family: 'Plus Jakarta Sans', sans-serif; }
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('user.favorites') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition duration-200">
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
                     <h1 class="text-3xl font-extrabold text-[#334155] mb-2">🔥 Hot Today's Menu</h1>
                    <p class="text-[#64748B] font-medium">Menu spesial paling hits hari ini!</p>
                </div>
                
                <a href="{{ route('user.index') }}" class="w-12 h-12 bg-white rounded-2xl border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F1F5F9] transition text-[#64748B] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </header>

            <!-- Hot Today Grid -->
            @if($hotMenus->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($hotMenus as $menu)
                <div class="bg-white rounded-[32px] p-4 border border-[#F1F5F9] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl transition duration-300 relative group flex flex-col h-full transform hover:-translate-y-1">
                    <div class="absolute -top-3 -left-3 z-10">
                         <span class="bg-gradient-to-r from-orange-500 to-rose-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                            🔥 HOT
                        </span>
                    </div>
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
                             <button onclick="toggleFavorite({{ $menu->id }}, this)" class="w-10 h-10 rounded-xl flex items-center justify-center {{ in_array($menu->id, $favoriteIds ?? []) ? 'bg-rose-50 text-rose-500' : 'bg-[#F1F5F9] text-[#94A3B8]' }} hover:bg-rose-400 hover:text-white transition shadow-sm hover:shadow-lg hover:shadow-rose-400/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ in_array($menu->id, $favoriteIds ?? []) ? 'fill-current' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <button class="flex-1 rounded-xl bg-[#1E293B] text-white font-bold text-sm hover:bg-[#334155] transition py-2">
                                Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-[40px] p-20 text-center border border-dashed border-[#E2E8F0] opacity-80">
                <div class="w-24 h-24 bg-[#FFF1F2] rounded-full flex items-center justify-center mx-auto mb-6 text-rose-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-[#334155] mb-2">Belum ada menu hot today</h3>
                <p class="text-[#64748B]">Nantikan menu spesial pilihan admin hari ini!</p>
                <a href="{{ route('user.index') }}" class="inline-block mt-6 px-6 py-3 bg-rose-500 text-white rounded-xl font-bold hover:bg-rose-600 transition shadow-lg shadow-rose-500/20">
                    Lihat Semua Menu
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
                    const svg = btn.querySelector('svg');
                    
                    if (response.data.status === 'added') {
                        // Change style to active
                        btn.className = "w-10 h-10 rounded-2xl flex items-center justify-center bg-rose-50 text-rose-500 hover:bg-rose-400 hover:text-white transition shadow-sm hover:shadow-lg hover:shadow-rose-400/30";
                        svg.classList.add('fill-current');
                    } else {
                        // Change style to inactive
                        btn.className = "w-10 h-10 rounded-2xl flex items-center justify-center bg-[#F1F5F9] text-[#94A3B8] hover:bg-rose-400 hover:text-white transition shadow-sm hover:shadow-lg hover:shadow-rose-400/30";
                        svg.classList.remove('fill-current');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan');
                });
        }
    </script>
</body>
</html>
