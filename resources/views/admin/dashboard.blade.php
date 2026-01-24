@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Selamat Datang, ' . Auth::user()->name . ' 👋')
@section('header_subtitle', 'Login sebagai: ' . strtoupper(Auth::user()->role))

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div class="text-gray-400 text-sm font-medium">Pendapatan</div>
            <div class="p-2 bg-green-50 text-green-500 rounded-lg">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $stats['revenue'] }}</div>
        <div class="text-green-500 text-[10px] font-medium mt-1 flex items-center">
            <i class="fas fa-arrow-up mr-1 text-[8px]"></i>
            +2.5% dari kemarin
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div class="text-gray-400 text-sm font-medium">Pesanan</div>
            <div class="p-2 bg-blue-50 text-blue-500 rounded-lg">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $stats['orders'] }}</div>
        <div class="text-blue-500 text-[10px] font-medium mt-1">
            <i class="fas fa-plus mr-1"></i>{{ $stats['orders'] }} baru masuk
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div class="text-gray-400 text-sm font-medium">Users</div>
            <div class="p-2 bg-purple-50 text-purple-500 rounded-lg">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $stats['users'] }}</div>
        <div class="text-purple-500 text-[10px] font-medium mt-1">
            Total terdaftar
        </div>
    </div>
</div>

<!-- Sales Chart -->
<div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50 mb-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Grafik Penjualan</h3>
            <p class="text-gray-400 text-sm">Statistik pendapatan 7 hari terakhir</p>
        </div>
        <div class="flex items-center space-x-2 bg-gray-50 p-1.5 rounded-xl border border-gray-100">
            <button class="px-4 py-1.5 bg-white text-gray-800 text-xs font-bold rounded-lg shadow-sm">7 Hari</button>
            <button class="px-4 py-1.5 text-gray-400 text-xs font-medium hover:text-gray-600 transition-colors">30 Hari</button>
        </div>
    </div>
    <div class="h-80 w-full">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<!-- Grid for Orders & Hot Today -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-50">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Pesanan Terbaru</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-red-500 font-medium hover:text-red-600">Lihat Semua</a>
        </div>
        <div class="space-y-4">
            @forelse($recentOrders as $order)
            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer group" onclick="window.location='{{ route('admin.orders.show', $order->id) }}'">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-500 font-bold text-sm group-hover:bg-red-100 transition-colors">
                        {{ substr($order->customer_name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-800 group-hover:text-red-600 transition-colors text-truncate max-w-[150px]">{{ $order->customer_name }}</div>
                        <div class="text-[10px] text-gray-400">Order #{{ $order->id }} • {{ $order->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm font-bold text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                    <div class="text-[9px] font-black uppercase {{ $order->status == 'completed' ? 'text-green-500' : 'text-orange-500' }}">
                        {{ $order->status }}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-400 py-4">Belum ada pesanan</div>
            @endforelse
        </div>
    </div>

    <!-- Hot Today -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-50">
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
                    <div class="w-12 h-12 rounded-xl bg-white overflow-hidden border border-orange-100 shadow-sm">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-800 group-hover:text-orange-700 transition-colors">{{ $menu->name }}</div>
                        <div class="text-[10px] text-gray-500 uppercase font-medium">{{ $menu->category }} • Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                    </div>
                </div>
                <span class="px-2 py-1 bg-orange-500 text-white text-[8px] font-black rounded-full shadow-sm shadow-orange-200">ACTIVE</span>
            </div>
            @empty
            <div class="text-center py-12 text-gray-400 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100">
                <i class="fas fa-info-circle mb-2 block text-xl"></i>
                <p class="text-xs font-medium">Belum ada menu Hot Today</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Create gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(239, 68, 68, 0.15)');
    gradient.addColorStop(1, 'rgba(239, 68, 68, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($chartData) !!},
                borderColor: '#ef4444',
                borderWidth: 4,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#ef4444',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    titleFont: { size: 14, family: 'Outfit', weight: 'bold' },
                    bodyFont: { size: 13, family: 'Outfit' },
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: {
                        font: { size: 11, family: 'Outfit' },
                        color: '#9ca3af',
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + 'jt';
                            if (value >= 1000) return 'Rp ' + (value/1000) + 'rb';
                            return 'Rp ' + value;
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { 
                        font: { size: 11, family: 'Outfit' },
                        color: '#9ca3af'
                    }
                }
            }
        }
    });
</script>
@endsection
