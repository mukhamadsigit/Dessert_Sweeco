<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Hot Today - Sweeco Admin</title>
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
</head>
<body class="bg-[#FDF6F0] min-h-screen">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-100 hidden md:block fixed h-full">
            <div class="p-8">
                <h1 class="text-2xl font-bold text-red-500 mb-8">Sweeco.</h1>
                <nav class="space-y-2">
                    <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan</span>
                    </a>
                    <a href="{{ route('admin.menu.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <i class="fas fa-utensils"></i>
                        <span>Menu</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.hot-today.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-orange-50 text-orange-500 rounded-xl font-medium">
                        <i class="fas fa-fire"></i>
                        <span>Hot Today</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium transition-colors w-full text-left mt-8">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="md:ml-64 flex-1 p-8">
            <div class="max-w-6xl mx-auto">
                <header class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Manajemen Hot Today</h2>
                        <p class="text-gray-500 text-sm">Pilih menu yang akan dipromosikan di halaman utama aplikasi</p>
                    </div>
                </header>

                @if(session('success'))
                <div class="bg-orange-100 border border-orange-200 text-orange-700 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($menus as $menu)
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-transparent hover:border-orange-100 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-orange-50 group-hover:text-orange-500 transition-colors">
                                <i class="fas fa-hamburger text-2xl"></i>
                            </div>
                            <form action="{{ route('admin.hot-today.toggle', $menu->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-full transition-colors {{ $menu->is_hot_today ? 'bg-orange-500 text-white shadow-lg shadow-orange-100' : 'bg-gray-100 text-gray-400 hover:bg-orange-100 hover:text-orange-500' }}">
                                    <i class="fas fa-fire text-sm"></i>
                                </button>
                            </form>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1">{{ $menu->name }}</h3>
                        <p class="text-xs text-gray-400 mb-4">{{ $menu->category }} • Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] font-bold px-2 py-1 rounded-lg {{ $menu->is_hot_today ? 'bg-orange-100 text-orange-600' : 'bg-gray-100 text-gray-400' }}">
                                {{ $menu->is_hot_today ? 'HOT TODAY' : 'REGULAR' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 text-gray-400">
                        <i class="fas fa-utensils text-4xl mb-4 block"></i>
                        Belum ada menu yang terdaftar. <a href="{{ route('admin.menu.create') }}" class="text-red-500 underline">Tambah menu dulu.</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

</body>
</html>
