<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    @yield('styles')
</head>
<body class="bg-[#FDF6F0] min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 hidden md:block fixed h-full z-10">
        <div class="p-8 h-full flex flex-col">
            <h1 class="text-2xl font-bold text-red-500 mb-8">Sweeco.</h1>
            
            <nav class="space-y-2 flex-grow">
                <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->is('dashboard') || request()->is('admin') ? 'bg-red-50 text-red-500' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <i class="fas fa-th-large w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-red-500' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <i class="fas fa-shopping-bag w-5"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('admin.menu.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.menu.*') ? 'bg-red-50 text-red-500' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <i class="fas fa-utensils w-5"></i>
                    <span>Menu</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-500' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.hot-today.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-colors {{ request()->routeIs('admin.hot-today.*') ? 'bg-orange-50 text-orange-500' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50' }}">
                    <i class="fas fa-fire w-5 text-orange-400"></i>
                    <span>Hot Today</span>
                </a>
            </nav>

            <div class="mt-auto pt-8 border-t border-gray-100">
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 p-3 rounded-2xl hover:bg-gray-50 transition-colors mb-4 group">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-100 transition-colors overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="text-xs font-bold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-gray-400 uppercase font-bold">{{ Auth::user()->role }}</div>
                    </div>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium transition-colors w-full text-left">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 flex-1 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">@yield('header_title', 'Admin Panel')</h2>
                <p class="text-gray-500 text-sm">@yield('header_subtitle', 'Selamat datang di dashboard Sweeco')</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500 cursor-pointer hover:bg-red-200 transition-colors">
                    <i class="fas fa-bell"></i>
                </div>
                <a href="{{ route('admin.profile') }}" class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                </a>
            </div>
        </header>

        @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-sm">
            <i class="fas fa-check-circle mr-3"></i>
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
