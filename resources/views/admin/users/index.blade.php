<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Sweeco Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
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
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-red-50 text-red-500 rounded-xl font-medium">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.hot-today.index') }}" class="flex items-center space-x-3 px-4 py-3 text-orange-400 hover:text-orange-600 hover:bg-orange-50 rounded-xl font-medium transition-colors">
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
                        <h2 class="text-2xl font-bold text-gray-800">Manajemen User (Aplikasi)</h2>
                        <p class="text-gray-500 text-sm">Pantau dan kelola user yang terdaftar di aplikasi Sweeco</p>
                    </div>
                </header>

                @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 border-bottom border-gray-100">
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">User</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Email</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Terdaftar</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-100 overflow-hidden">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}">
                                            </div>
                                            <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-[10px] font-bold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                            {{ strtoupper($user->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold {{ $user->status === 'active' ? 'bg-orange-50 text-orange-600 hover:bg-orange-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} transition-colors">
                                                <i class="fas {{ $user->status === 'active' ? 'fa-ban' : 'fa-check' }} mr-1"></i>
                                                {{ $user->status === 'active' ? 'Ban' : 'Unban' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <i class="fas fa-users-slash text-4xl mb-4 block"></i>
                                        Belum ada user aplikasi yang terdaftar
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($users->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

</body>
</html>
