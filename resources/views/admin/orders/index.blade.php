<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        body { font-family: 'Outfit', sans-serif; background-color: #FDF6F0; }
    </style>
</head>
<body class="bg-[#FDF6F0] min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 hidden md:block fixed h-full">
        <div class="p-8">
            <h1 class="text-2xl font-bold text-red-500 mb-8">Sweeco.</h1>
            <nav class="space-y-2">
                <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-red-50 text-red-500 rounded-xl font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('admin.menu.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span>Menu</span>
                </a>
                <a href="{{ route('admin.hot-today.index') }}" class="flex items-center space-x-3 px-4 py-3 text-orange-400 hover:text-orange-600 hover:bg-orange-50 rounded-xl font-medium transition-colors">
                    <i class="fas fa-fire"></i>
                    <span>Hot Today</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 flex-1 p-8">
        <header class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Pesanan</h2>
        </header>

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-sm">
                        <tr>
                            <th class="p-4 font-medium">ID Order</th>
                            <th class="p-4 font-medium">Nama Pelanggan</th>
                            <th class="p-4 font-medium text-right">Total</th>
                            <th class="p-4 font-medium text-center">Status</th>
                            <th class="p-4 font-medium">Tanggal</th>
                            <th class="p-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-bold text-gray-800">#{{ $order->id }}</td>
                            <td class="p-4 text-gray-600">{{ $order->customer_name }}</td>
                            <td class="p-4 text-gray-800 font-medium text-right">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-600' : 
                                       ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500 text-sm">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-red-500 hover:text-red-700 font-medium text-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>
