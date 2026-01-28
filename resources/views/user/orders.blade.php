<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya - Sweeco</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

                    <a href="{{ route('user.favorites') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl text-[#64748B] hover:bg-[#F8FAFC] hover:text-[#334155] transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Favorit</span>
                    </a>
                    
                    <a href="{{ route('user.orders') }}" class="flex items-center space-x-3 p-3.5 rounded-2xl bg-[#FFF1F2] text-[#E11D48] font-bold shadow-sm">
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
                     <h1 class="text-3xl font-extrabold text-[#334155] mb-2">Riwayat Pesanan</h1>
                    <p class="text-[#64748B] font-medium">Daftar semua transaksi dessert manismu</p>
                </div>
                
                <a href="{{ route('user.index') }}" class="w-12 h-12 bg-white rounded-2xl border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F1F5F9] transition text-[#64748B] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </header>

            <!-- Orders List -->
            <div class="space-y-8">
                @forelse($orders as $order)
                <div class="bg-white rounded-[32px] p-8 border border-[#F1F5F9] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl transition duration-300 relative overflow-hidden group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-8 border-b border-dashed border-[#E2E8F0]">
                        <div class="flex items-center space-x-5 mb-4 md:mb-0">
                            <div class="w-16 h-16 bg-[#FFF1F2] rounded-2xl flex items-center justify-center text-[#F43F5E] group-hover:scale-105 transition duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-[#334155]">#ORD-{{ $order->id }}</h4>
                                <p class="text-[#94A3B8] text-sm font-medium mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-widest mb-2 {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-500' : ($order->status === 'cancelled' ? 'bg-rose-50 text-rose-500' : 'bg-orange-50 text-orange-500') }}">
                                {{ $order->status }}
                            </span>
                            <p class="text-2xl font-black text-[#334155]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($order->items as $item)
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-[#F8FAFC] shrink-0 border border-white shadow-sm">
                                <img src="{{ $item->menu->image_url }}" alt="{{ $item->menu->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-bold text-[#475569] truncate">{{ $item->menu->name }}</h5>
                                <p class="text-[#94A3B8] text-sm font-medium">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-[40px] p-20 text-center border border-dashed border-[#E2E8F0] opacity-80">
                    <div class="w-24 h-24 bg-[#F1F5F9] rounded-full flex items-center justify-center mx-auto mb-6 text-[#94A3B8]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#334155] mb-2">Belum ada pesanan</h3>
                    <p class="text-[#64748B]">Dessert manismu sudah menunggu untuk dipesan!</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>
