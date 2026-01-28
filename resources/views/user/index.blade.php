<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard User - Sweeco</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-item-active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid #FCA5A5;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .category-chip {
            transition: all 0.3s ease;
        }
        .category-chip-active {
            background: #991B1B;
            color: white;
            box-shadow: 0 4px 12px rgba(153, 27, 27, 0.3);
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(153, 27, 27, 0.1);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white min-h-screen border-r border-[#F1F5F9] hidden lg:block sticky top-0 h-screen overflow-y-auto font-medium z-30 flex-shrink-0">
            <div class="px-6 py-8">
                <div class="text-2xl font-bold tracking-tight mb-10 text-[#334155]">Sweeco <br><span class="text-sm font-normal text-[#F43F5E] tracking-widest bg-clip-text text-transparent bg-gradient-to-r from-rose-500 to-orange-400">USER DASHBOARD</span></div>
                
                <nav class="space-y-2">
                    <a href="{{ route('user.index') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl bg-[#FFF1F2] text-[#E11D48] font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
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
        <main class="flex-1 min-h-screen p-8 lg:p-12 bg-[#F8FAFC]">
            <!-- Header -->
            <div class="flex justify-between items-start mb-10">
                <div>
                   <h1 class="text-4xl font-extrabold text-[#334155] mb-2">Selamat Datang, 
                       <span class="bg-clip-text text-transparent bg-gradient-to-r from-rose-500 to-orange-400">
                           {{ explode(' ', auth()->user()->name)[0] }}
                       </span>
                    </h1>
                   <p class="text-[#64748B] font-medium flex items-center">
                       <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2"></span>
                       {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
                    </p>
                </div>
                
                <!-- User Profile & Cart -->
                 <div class="flex items-center space-x-4">
                    <button onclick="toggleCart()" class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F1F5F9] transition relative text-[#64748B] group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:text-rose-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span id="cart-badge" class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-rose-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white shadow-sm">0</span>
                    </button>
                    <div class="w-12 h-12 rounded-2xl overflow-hidden border-2 border-white shadow-md p-0.5 bg-gradient-to-tr from-rose-400 to-orange-300">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=fff&color=F43F5E" class="w-full h-full rounded-xl object-cover border border-white">
                    </div>
                </div>
            </div>

            <!-- Hot Today Banner -->
            <a href="{{ route('user.hot-today') }}" class="block transform hover:scale-[1.01] transition duration-300">
                <div class="bg-gradient-to-br from-orange-500 to-rose-500 text-white p-6 rounded-[32px] flex items-center justify-between mb-12 shadow-xl shadow-orange-500/20 relative overflow-hidden group">
                     <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20 group-hover:bg-white/20 transition duration-700"></div>
                     <div class="absolute left-10 bottom-0 w-32 h-32 bg-white/10 rounded-full blur-2xl opacity-20"></div>
                    <div class="flex items-center font-bold text-sm md:text-base z-10 w-full justify-between">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mr-5 border border-white/10 shrink-0">
                                <span class="text-2xl animate-pulse">🔥</span>
                            </div>
                            <div>
                                <span class="block text-white/80 text-xs font-bold tracking-wider mb-0.5 uppercase">Rekomendasi Spesial</span>
                                <span class="text-xl md:text-2xl font-black">Hot Today's Menu</span>
                                <p class="text-white/90 text-sm font-normal mt-1 hidden md:block">Cek menu paling hits pilihan kami hari ini!</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-[32px] border border-gray-50 relative hover:-translate-y-2 transition duration-500 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400">TOTAL BELANJA</span>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-[#1E293B] mb-1">Rp {{ number_format($stats['total_spend'], 0, ',', '.') }}</h3>
                        <p class="text-rose-500 font-medium text-xs flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            Updated just now
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                 <div class="bg-white p-6 rounded-[32px] border border-gray-50 relative hover:-translate-y-2 transition duration-500 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl">
                     <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                            <span class="text-xl font-black">#</span>
                        </div>
                         <span class="text-xs font-bold text-gray-400">TOTAL PESANAN</span>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-[#1E293B] mb-1">{{ $stats['total_orders'] }} <span class="text-lg font-bold text-gray-400">Order</span></h3>
                         <p class="text-orange-500 font-medium text-xs flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            Active Customer
                        </p>
                    </div>
                </div>

                 <!-- Card 3 (Points) -->
                  <div class="bg-white p-6 rounded-[32px] border border-gray-50 relative hover:-translate-y-2 transition duration-500 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase">Poinku</span>
                    </div>
                     <div>
                        <h3 class="text-3xl font-black text-[#1E293B] mb-1">{{ $stats['points'] ?? 0 }} <span class="text-lg font-bold text-gray-400">Pts</span></h3>
                        <p class="text-purple-500 font-medium text-xs flex items-center">
                            Loyalty Rewards
                        </p>
                    </div>
                </div>
            </div>

            <!-- Search Bar Section -->
            <div class="flex gap-4 mb-8">
                <div class="flex-1 bg-white rounded-2xl flex items-center px-6 py-4 shadow-sm border border-gray-100 focus-within:ring-2 focus-within:ring-rose-500/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-input" onkeyup="searchMenu()" placeholder="Cari dessert..." class="w-full bg-transparent outline-none text-gray-700 font-bold placeholder-gray-400">
                </div>
                <button class="bg-rose-500 text-white px-8 rounded-2xl font-bold flex items-center shadow-lg shadow-rose-500/20 hover:bg-rose-600 transition">
                    Filter
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
            </div>

            <!-- Explore Categories -->
            <div class="mb-10">
                <h3 class="text-xl font-black text-[#334155] mb-6">Kategori</h3>
                <div class="flex space-x-6 overflow-x-auto pb-4 hide-scrollbar">
                     <button onclick="filterCategory('all')" class="category-pill group bg-white px-8 py-4 rounded-[2rem] border border-gray-100 hover:border-rose-500 hover:shadow-xl hover:shadow-rose-500/10 transition-all flex items-center space-x-4 text-left min-w-max" data-category="all">
                        <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 text-2xl group-hover:scale-110 transition">
                             🍽️
                        </div>
                        <span class="font-bold text-gray-600 group-hover:text-gray-900 text-base">Semua Menu</span>
                    </button>

                    @foreach($categories as $cat)
                    <button onclick="filterCategory('{{ Str::slug($cat) }}')" class="category-pill group bg-white px-8 py-4 rounded-[2rem] border border-gray-100 hover:border-rose-500 hover:shadow-xl hover:shadow-rose-500/10 transition-all flex items-center space-x-4 text-left min-w-max" data-category="{{ Str::slug($cat) }}">
                         <div class="w-14 h-14 rounded-2xl bg-{{ $loop->iteration % 2 == 0 ? 'orange' : 'rose' }}-50 flex items-center justify-center text-2xl group-hover:scale-110 transition">
                             @if(Str::contains(Str::lower($cat), 'cookie')) 🍪
                             @elseif(Str::contains(Str::lower($cat), 'bowl')) 🥗
                             @elseif(Str::contains(Str::lower($cat), 'pudding')) 🍮
                             @elseif(Str::contains(Str::lower($cat), 'pie')) 🥧
                             @else 🍰 @endif
                        </div>
                        <span class="font-bold text-gray-600 group-hover:text-gray-900 text-base">{{ $cat }}</span>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Menu Grid using Cards -->
            <div class="mb-8">
                <div class="flex items-center space-x-6 mb-6 border-b border-gray-100 pb-2">
                    <button id="tab-popular" onclick="switchTab('popular')" class="text-lg font-black text-[#334155] border-b-4 border-rose-500 pb-2 -mb-3 transition-all">Semua</button>
                    <button id="tab-recent" onclick="switchTab('recent')" class="text-lg font-bold text-gray-400 hover:text-gray-600 transition pb-2 border-b-4 border-transparent -mb-3">Pesan Lagi</button>
                </div>

                <!-- Popular Grid -->
                <div id="menu-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 animate-fade-in">
                    @foreach($groupedMenus as $items)
                        @foreach($items as $menu)
                        <div class="menu-item bg-white p-4 rounded-[32px] border border-gray-50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl transition-all duration-300 group flex flex-col" data-category="{{ Str::slug($menu->category) }}">
                             <!-- Checkbox / Select (Visual from reference) -->
                             <div class="absolute top-6 left-6 z-10 w-6 h-6 bg-rose-500 rounded-lg flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition shadow-lg transform scale-0 group-hover:scale-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                             </div>

                            <div class="h-48 rounded-3xl overflow-hidden mb-4 relative bg-[#F8FAFC]">
                                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            </div>

                            <div class="flex-1 flex flex-col">
                                <h4 class="font-bold text-[#1E293B] text-xl mb-1 line-clamp-1">{{ $menu->name }}</h4>
                                @if(!empty($menu->tags))
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($menu->tags as $tag)
                                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-[#F1F5F9] text-[#64748B] border border-gray-100">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="flex justify-between items-center mb-6">
                                    <div class="flex items-baseline">
                                        <span class="text-rose-500 font-black text-xl">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                    </div>
                                     <div class="flex items-center text-xs font-bold text-orange-400 bg-orange-50 px-2 py-1 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        {{ number_format(4.5 + (fmod($menu->id, 5) / 10), 1) }}
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-auto">
                                     <button onclick="toggleFavorite({{ $menu->id }}, this)" class="h-12 px-4 rounded-2xl flex items-center justify-center {{ in_array($menu->id, $favoriteIds ?? []) ? 'bg-rose-50 text-rose-500 border-rose-100' : 'bg-gray-50 text-gray-400 border-gray-100' }} border-2 hover:bg-rose-50 hover:text-rose-500 hover:border-rose-200 transition group/btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ in_array($menu->id, $favoriteIds ?? []) ? 'fill-current' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button onclick="addToCart('{{ $menu->id }}', '{{ $menu->name }}', {{ $menu->price }})" class="flex-1 h-12 bg-[#F43F5E] text-white rounded-2xl font-bold hover:bg-[#E11D48] transition shadow-lg shadow-rose-500/30 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        <span class="md:hidden lg:inline">Pesan Sekarang</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>

                <!-- Recent Grid (Hidden by Default) -->
                <div id="recent-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 hidden animate-fade-in">
                    @forelse($recentMenus as $menu)
                    <div class="menu-item bg-white p-4 rounded-[32px] border border-gray-50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl transition-all duration-300 group flex flex-col" data-category="{{ Str::slug($menu->category) }}">
                        <div class="h-48 rounded-3xl overflow-hidden mb-4 relative bg-[#F8FAFC]">
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                             <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-rose-500 shadow-sm custom-font">
                                Last Ordered
                            </span>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <h4 class="font-bold text-[#1E293B] text-xl mb-1 line-clamp-1">{{ $menu->name }}</h4>
                             <div class="flex justify-between items-center mb-6">
                                <span class="text-rose-500 font-black text-xl">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex gap-3 mt-auto">
                                    <button onclick="toggleFavorite({{ $menu->id }}, this)" class="h-12 px-4 rounded-2xl flex items-center justify-center {{ in_array($menu->id, $favoriteIds ?? []) ? 'bg-rose-50 text-rose-500 border-rose-100' : 'bg-gray-50 text-gray-400 border-gray-100' }} border-2 hover:bg-rose-50 hover:text-rose-500 hover:border-rose-200 transition group/btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ in_array($menu->id, $favoriteIds ?? []) ? 'fill-current' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                                <button onclick="addToCart('{{ $menu->id }}', '{{ $menu->name }}', {{ $menu->price }})" class="flex-1 h-12 bg-[#1E293B] text-white rounded-2xl font-bold hover:bg-[#334155] transition shadow-lg flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <span class="md:hidden lg:inline">Pesan lagi</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center text-gray-400">
                        <p class="font-bold text-lg">Belum ada riwayat pesanan</p>
                        <p class="text-sm">Yuk pesan sesuatu!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <!-- Cart Drawer -->
    <div id="cart-drawer" class="fixed inset-y-0 right-0 w-full md:w-[450px] bg-white shadow-2xl z-[100] transform translate-x-full transition-transform duration-500 ease-in-out border-l border-gray-100">
        <div class="flex flex-col h-full">
            <!-- Drawer Header -->
            <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Keranjang</h3>
                    <p id="drawer-item-count" class="text-gray-400 text-sm font-medium">0 items selected</p>
                </div>
                <button onclick="toggleCart()" class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Drawer Content -->
            <div id="cart-items" class="flex-1 overflow-y-auto p-8 space-y-6">
                <!-- Cart items will be injected here -->
                <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <p class="font-bold">Keranjangmu masih kosong</p>
                    <p class="text-sm">Yuk pilih dessert favoritmu!</p>
                </div>
            </div>

            <!-- Drawer Footer -->
            <div class="p-8 bg-gray-50/50 border-t border-gray-50">
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-gray-500 font-medium">
                        <span>Subtotal</span>
                        <span id="cart-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-gray-900 text-xl font-bold pt-4 border-t border-gray-100">
                        <span>Total</span>
                        <span id="cart-total" class="text-[#991B1B]">Rp 0</span>
                    </div>
                </div>
                <button onclick="submitOrder()" id="checkout-btn" class="w-full py-5 bg-[#7F1D1D] text-white rounded-3xl font-bold shadow-xl hover:bg-[#991B1B] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    Pesan Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="cart-overlay" onclick="toggleCart()" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[90] hidden transition-opacity duration-300"></div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[250] hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-[32px] w-full max-w-md p-8 shadow-2xl transform transition-all scale-100">
            <h3 class="text-2xl font-bold text-[#7F1D1D] mb-6 text-center">Konfirmasi Pesanan</h3>
            
            <div class="space-y-4 mb-8">
                <div class="flex justify-between items-center text-sm font-medium text-gray-500">
                    <span>Total Item</span>
                    <span id="confirm-total-items" class="text-gray-900 font-bold">0 Items</span>
                </div>
                <div class="flex justify-between items-center text-lg font-bold text-[#7F1D1D]">
                    <span>Total Bayar</span>
                    <span id="confirm-total-price">Rp 0</span>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-3">Metode Pembayaran</label>
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <button onclick="selectPayment('COD')" id="pay-cod" class="payment-option p-3 rounded-xl border-2 border-gray-100 text-sm font-bold text-gray-500 hover:border-[#991B1B] hover:text-[#991B1B] transition flex flex-col items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        COD
                    </button>
                    <button onclick="selectPayment('Transfer')" id="pay-transfer" class="payment-option p-3 rounded-xl border-2 border-gray-100 text-sm font-bold text-gray-500 hover:border-[#991B1B] hover:text-[#991B1B] transition flex flex-col items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                        Transfer
                    </button>
                    <button onclick="selectPayment('QRIS')" id="pay-qris" class="payment-option p-3 rounded-xl border-2 border-gray-100 text-sm font-bold text-gray-500 hover:border-[#991B1B] hover:text-[#991B1B] transition flex flex-col items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        QRIS
                    </button>
                </div>

                <!-- Bank Selection Options -->
                <div id="bank-options" class="hidden grid grid-cols-2 gap-3 mb-4 animate-fade-in-down">
                    <button onclick="selectBank('Mandiri')" class="bank-option p-3 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition">Mandiri</button>
                    <button onclick="selectBank('BCA')" class="bank-option p-3 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition">BCA</button>
                    <button onclick="selectBank('BRI')" class="bank-option p-3 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition">BRI</button>
                    <button onclick="selectBank('BNI')" class="bank-option p-3 rounded-lg border border-gray-200 text-sm font-semibold text-gray-600 hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition">BNI</button>
                </div>
            </div>

            <div id="address-field" class="hidden mb-8 animate-fade-in-down">
                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Pengiriman (Wajib untuk COD)</label>
                <textarea id="delivery-address" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 focus:ring-2 focus:ring-[#991B1B] focus:border-transparent outline-none transition text-sm text-gray-700 font-medium" placeholder="Masukkan alamat lengkap Anda..."></textarea>
            </div>

            <div class="flex space-x-4">
                <button onclick="closeConfirmation()" class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">Batal</button>
                <button onclick="processedCheckout()" id="confirm-btn" class="flex-1 py-3 bg-[#7F1D1D] text-white rounded-xl font-bold hover:bg-[#991B1B] transition shadow-lg shadow-red-900/20 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Pesan Sekarang
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Configure Axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let cart = [];
        let selectedPaymentMethod = null;
        const cartBadge = document.getElementById('cart-badge');
        const cartDrawer = document.getElementById('cart-drawer');
        const cartOverlay = document.getElementById('cart-overlay');
        const cartItemsContainer = document.getElementById('cart-items');
        const subtotalEl = document.getElementById('cart-subtotal');
        const totalEl = document.getElementById('cart-total');
        const confirmationModal = document.getElementById('confirmation-modal');

        function toggleCart() {
            cartDrawer.classList.toggle('translate-x-full');
            cartOverlay.classList.toggle('hidden');
            renderCart();
        }

        function addToCart(id, name, price) {
            const existing = cart.find(i => i.id === id);
            
            if (existing) {
                existing.quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            
            updateCartUI();
            showToast(name);
        }

        function updateQuantity(id, change) {
            const item = cart.find(i => i.id === id);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart = cart.filter(i => i.id !== id);
                }
                updateCartUI();
                renderCart();
            }
        }

        function updateCartUI() {
            const total = getTotalItems();
            if (cartBadge) cartBadge.innerText = total;
            if (itemCountEl) itemCountEl.innerText = `${total} items selected`;
        }

        function renderCart() {
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="font-bold">Keranjangmu masih kosong</p>
                        <p class="text-sm">Yuk pilih dessert favoritmu!</p>
                    </div>
                `;
                subtotalEl.innerText = 'Rp 0';
                totalEl.innerText = 'Rp 0';
                return;
            }

            let cartHtml = '';
            let totalAmount = 0;

            cart.forEach(item => {
                const subtotal = item.price * item.quantity;
                totalAmount += subtotal;
                cartHtml += `
                    <div class="flex items-center space-x-4 bg-white p-4 rounded-3xl border border-gray-50 shadow-sm">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900 truncate">${item.name}</h4>
                            <p class="text-[#991B1B] text-sm font-bold">Rp ${item.price.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="flex items-center bg-gray-50 rounded-2xl p-1 shrink-0">
                            <button onclick="updateQuantity('${item.id}', -1)" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <span class="w-8 text-center font-bold text-sm">${item.quantity}</span>
                            <button onclick="updateQuantity('${item.id}', 1)" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            });

            cartItemsContainer.innerHTML = cartHtml;
            subtotalEl.innerText = `Rp ${totalAmount.toLocaleString('id-ID')}`;
            totalEl.innerText = `Rp ${totalAmount.toLocaleString('id-ID')}`;
        }

        function showToast(name) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-10 right-10 bg-[#7F1D1D] text-white px-6 py-4 rounded-2xl shadow-2xl z-[200] transform translate-y-20 opacity-0 transition-all duration-500 flex items-center space-x-3';
            toast.innerHTML = `
                <div class="w-8 h-8 bg-red-800 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                   <p class="font-bold text-sm">${name} ditambahkan!</p>
                   <p class="text-white/70 text-[10px]">Total items: ${getTotalItems()}</p>
                </div>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
            }, 100);
            
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        function getTotalItems() {
            return cart.reduce((sum, item) => sum + item.quantity, 0);
        }

        function submitOrder() {
            if (cart.length === 0) return;
            
            // Show Confirmation Modal Instead of direct submit
            const totalItems = getTotalItems();
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            document.getElementById('confirm-total-items').innerText = `${totalItems} Items`;
            document.getElementById('confirm-total-price').innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
            
            // Reset state
            selectedPaymentMethod = null;
            document.querySelectorAll('.payment-option').forEach(el => {
                el.classList.remove('border-[#991B1B]', 'text-[#991B1B]', 'bg-red-50');
                el.classList.add('border-gray-100', 'text-gray-500');
            });
            document.getElementById('confirm-btn').disabled = true;

            toggleCart(); // Close drawer
            confirmationModal.classList.remove('hidden');
        }

        function closeConfirmation() {
            confirmationModal.classList.add('hidden');
            toggleCart(); // Reopen drawer
        }

        function selectPayment(method) {
            selectedPaymentMethod = method; // Default, might be updated if bank is selected
            
            const bankOptions = document.getElementById('bank-options');
            const confirmBtn = document.getElementById('confirm-btn');

            // Reset Sub-options
            bankOptions.classList.add('hidden');
            document.querySelectorAll('.bank-option').forEach(el => {
                el.classList.remove('bg-red-50', 'border-red-500', 'text-red-600');
                el.classList.add('border-gray-200', 'text-gray-600');
            });

            // Update Main Payment UI styling
            document.querySelectorAll('.payment-option').forEach(el => {
                el.classList.remove('border-[#991B1B]', 'text-[#991B1B]', 'bg-red-50');
                el.classList.add('border-gray-100', 'text-gray-500');
            });
            
            const selectedBtnId = method === 'COD' ? 'pay-cod' : (method === 'Transfer' ? 'pay-transfer' : 'pay-qris');
            const selectedBtn = document.getElementById(selectedBtnId);
            if(selectedBtn) {
                selectedBtn.classList.remove('border-gray-100', 'text-gray-500');
                selectedBtn.classList.add('border-[#991B1B]', 'text-[#991B1B]', 'bg-red-50');
            }

            // Logic per Method
            if (method === 'COD') {
                confirmBtn.disabled = false; // Always enabled as address is in DB
            } else if (method === 'Transfer') {
                bankOptions.classList.remove('hidden');
                selectedPaymentMethod = null; // Wait for specific bank selection
                confirmBtn.disabled = true;
            } else {
                confirmBtn.disabled = false;
            }
        }

        function selectBank(bankName) {
            selectedPaymentMethod = `Transfer - ${bankName}`;
            
            // Visual Feedback
            document.querySelectorAll('.bank-option').forEach(el => {
                el.classList.remove('bg-red-50', 'border-red-500', 'text-red-600');
                el.classList.add('border-gray-200', 'text-gray-600');
            });
            
            // Find the clicked button (event target approach usually better, but iterating for simplicity in string replacement)
            const buttons = document.querySelectorAll('.bank-option');
            for(let btn of buttons) {
                if(btn.innerText === bankName) {
                     btn.classList.add('bg-red-50', 'border-red-500', 'text-red-600');
                     btn.classList.remove('border-gray-200', 'text-gray-600');
                     break;
                }
            }

            document.getElementById('confirm-btn').disabled = false;
        }

        async function processedCheckout() {
            if (!selectedPaymentMethod) return;

            const btn = document.getElementById('confirm-btn');
            const originalText = btn.innerText;
            btn.disabled = true;
            btn.innerText = 'Memproses...';

            try {
                const response = await fetch('{{ route("user.checkout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        items: cart,
                        payment_method: selectedPaymentMethod,
                        // Address removed from payload
                    })
                });

                const result = await response.json();

                if (result.success) {
                    cart = [];
                    updateCartUI();
                    confirmationModal.classList.add('hidden');
                    
                    // Show success feedback
                    const successModal = document.createElement('div');
                    successModal.className = 'fixed inset-0 bg-black/50 backdrop-blur-md z-[300] flex items-center justify-center p-6';
                    successModal.innerHTML = `
                        <div class="bg-white rounded-[40px] p-10 max-w-sm w-full text-center shadow-2xl transform scale-90 opacity-0 transition-all duration-500">
                            <div class="w-20 h-20 bg-red-100 text-[#7F1D1D] rounded-3xl flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-[#7F1D1D] mb-2">Pesanan Diterima!</h3>
                            <p class="text-gray-500 mb-8">Metode: ${selectedPaymentMethod}<br>Pesananmu sedang diproses oleh tim Sweeco.</p>
                            <button onclick="window.location.href='{{ route('user.orders') }}'" class="w-full py-4 bg-[#991B1B] text-white rounded-2xl font-bold hover:bg-[#7F1D1D] transition shadow-lg">
                                Lihat Pesanan Saya
                            </button>
                        </div>
                    `;
                    document.body.appendChild(successModal);
                    
                    setTimeout(() => {
                        successModal.querySelector('div').classList.remove('scale-90', 'opacity-0');
                    }, 50);

                } else {
                    alert('Gagal: ' + result.message);
                }
            } catch (error) {
                alert('Terjadi kesalahan koneksi.');
            } finally {
                btn.disabled = false;
                btn.innerText = originalText;
            }
        }

        function filterCategory(slug) {
            // Update chip/pill styles
            const chips = document.querySelectorAll('.category-pill');
            chips.forEach(chip => {
                if (chip.getAttribute('data-category') === slug) {
                    // Active state: Rose fill, White text
                    chip.classList.remove('bg-white', 'text-[#64748B]', 'border-[#F1F5F9]');
                    chip.classList.add('bg-rose-500', 'text-white', 'border-transparent', 'shadow-lg', 'shadow-rose-500/20');
                } else {
                    // Inactive state: White fill, Gray text
                    chip.classList.add('bg-white', 'text-[#64748B]', 'border-[#F1F5F9]');
                    chip.classList.remove('bg-rose-500', 'text-white', 'border-transparent', 'shadow-lg', 'shadow-rose-500/20');
                }
            });

            // Filter menu items
            const items = document.querySelectorAll('.menu-item');
            if (slug === 'all') {
                items.forEach(item => item.classList.remove('hidden'));
            } else {
                items.forEach(item => {
                    if (item.getAttribute('data-category') === slug) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            }
        }

        function searchMenu() {
            const query = document.getElementById('search-input').value.toLowerCase();
            const items = document.querySelectorAll('.menu-item');

            items.forEach(item => {
                const nameNode = item.querySelector('h4');
                if (!nameNode) return;
                const name = nameNode.innerText.toLowerCase();
                if (name.includes(query)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }



        function toggleFavorite(id, btn) {
            axios.post(`/user/favorites/${id}`)
                .then(response => {
                    const svg = btn.querySelector('svg');
                    
                    if (response.data.status === 'added') {
                        // Change style to active
                        btn.className = "w-10 h-10 rounded-2xl flex items-center justify-center bg-rose-50 text-rose-500 hover:bg-rose-400 hover:text-white transition shadow-sm hover:shadow-lg hover:shadow-rose-400/30";
                        svg.classList.add('fill-current');
                        
                        // Show toast
                        // Check if showToast exists, if not use simple alert or console
                        if(typeof showToast === 'function') {
                            showToast(response.data.message, 'success'); 
                        }
                    } else {
                        // Change style to inactive
                        btn.className = "w-10 h-10 rounded-2xl flex items-center justify-center bg-[#F1F5F9] text-[#94A3B8] hover:bg-rose-400 hover:text-white transition shadow-sm hover:shadow-lg hover:shadow-rose-400/30";
                        svg.classList.remove('fill-current');
                        
                        if(typeof showToast === 'function') {
                            showToast(response.data.message, 'success');
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
        function switchTab(tab) {
            const popularGrid = document.getElementById('menu-list');
            const recentGrid = document.getElementById('recent-grid');
            const popularTab = document.getElementById('tab-popular');
            const recentTab = document.getElementById('tab-recent');

            if (tab === 'popular') {
                popularGrid.classList.remove('hidden');
                recentGrid.classList.add('hidden');
                
                popularTab.classList.remove('text-gray-400', 'border-transparent');
                popularTab.classList.add('text-[#334155]', 'border-rose-500');
                
                recentTab.classList.add('text-gray-400', 'border-transparent');
                recentTab.classList.remove('text-[#334155]', 'border-rose-500');
            } else {
                popularGrid.classList.add('hidden');
                recentGrid.classList.remove('hidden');
                
                recentTab.classList.remove('text-gray-400', 'border-transparent');
                recentTab.classList.add('text-[#334155]', 'border-rose-500');
                
                popularTab.classList.add('text-gray-400', 'border-transparent');
                popularTab.classList.remove('text-[#334155]', 'border-rose-500');
            }
        }
    </script>
</body>
</html>
