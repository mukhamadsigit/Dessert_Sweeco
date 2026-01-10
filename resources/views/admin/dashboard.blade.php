<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        red: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FDF6F0;
        }
    </style>
</head>
<body class="bg-[#FDF6F0] min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 hidden md:block fixed h-full">
        <div class="p-8">
            <h1 class="text-2xl font-bold text-red-500 mb-8">Sweeco.</h1>
            <nav class="space-y-2">
                <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 bg-red-50 text-red-500 rounded-xl font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('admin.menu.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span>Menu</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.hot-today.index') }}" class="flex items-center space-x-3 px-4 py-3 text-orange-400 hover:text-orange-600 hover:bg-orange-50 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.hot-today.*') ? 'bg-orange-50 text-orange-500' : '' }}">
                    <i class="fas fa-fire"></i>
                    <span>Hot Today</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium transition-colors w-full text-left mt-8">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 flex-1 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
                <p class="text-gray-500 text-sm">Login sebagai: <span class="uppercase font-bold text-red-500">{{ Auth::user()->role }}</span></p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-400 text-sm font-medium">Pendapatan</div>
                    <div class="p-2 bg-green-50 text-green-500 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['revenue'] }}</div>
                <div class="text-green-500 text-[10px] font-medium mt-1 flex items-center">
                    <svg class="w-2 h-2 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +2.5%
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-400 text-sm font-medium">Pesanan</div>
                    <div class="p-2 bg-blue-50 text-blue-500 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['orders'] }}</div>
                <div class="text-blue-500 text-[10px] font-medium mt-1">
                    +12 baru
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-400 text-sm font-medium">Users</div>
                    <div class="p-2 bg-purple-50 text-purple-500 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['users'] }}</div>
                <div class="text-purple-500 text-[10px] font-medium mt-1">
                    Total terdaftar
                </div>
            </div>
        </div>


        <!-- Hot Today & Recent Orders -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recent Orders (Keep for context) -->
            <div class="bg-white p-6 rounded-3xl shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Pesanan Terbaru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-red-500 font-medium hover:text-red-600">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @forelse($recentOrders as $order)
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer" onclick="window.location='{{ route('admin.orders.show', $order->id) }}'">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-500 font-bold text-sm">
                                {{ substr($order->customer_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-gray-800">{{ $order->customer_name }}</div>
                                <div class="text-xs text-gray-400">Order #{{ $order->id }}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-bold text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            <div class="text-[10px] {{ $order->status == 'completed' ? 'text-green-500' : ($order->status == 'pending' ? 'text-yellow-500' : 'text-red-500') }} font-medium uppercase">
                                {{ $order->status }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-400 py-4">Belum ada pesanan</div>
                    @endforelse
                </div>
            </div>

            <!-- Hot Today Section -->
            <div class="bg-white p-6 rounded-3xl shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-fire text-orange-500"></i>
                        <h3 class="text-lg font-bold text-gray-800">Hot Today (Apps)</h3>
                    </div>
                    <a href="{{ route('admin.menu.index') }}" class="text-sm text-red-500 font-medium hover:text-red-600">Kelola Menu</a>
                </div>
                <div class="grid grid-cols-1 gap-3">
                    @forelse($hotTodayMenus as $menu)
                    <div class="flex items-center justify-between p-4 bg-orange-50/50 rounded-2xl border border-orange-100 hover:border-orange-200 transition-all group">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm text-orange-500 font-bold">
                                {{ substr($menu->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-gray-800 group-hover:text-orange-700 transition-colors">{{ $menu->name }}</div>
                                <div class="text-[10px] text-gray-500">{{ $menu->category }} • Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <span class="px-2 py-1 bg-orange-500 text-white text-[9px] font-bold rounded-full shadow-sm shadow-orange-200">ACTIVE</span>
                    </div>
                    @empty
                    <div class="text-center py-12 text-gray-400">
                        <i class="fas fa-info-circle mb-2 block"></i>
                        <p class="text-xs">Belum ada menu yang ditandai sebagai Hot Today.</p>
                        <p class="text-[10px] mt-1">Gunakan Menu CRUD untuk menambahkan.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>


</body>
</html>