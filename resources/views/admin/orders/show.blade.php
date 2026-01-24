@extends('layouts.admin')

@section('title', 'Detail Order #' . $order->id)
@section('header_title', 'Detail Pesanan')
@section('header_subtitle', 'Informasi lengkap transaksi #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('admin.orders.index') }}" class="group flex items-center text-sm font-bold text-gray-400 hover:text-red-500 transition-colors">
            <div class="w-10 h-10 rounded-xl bg-white shadow-sm border border-gray-100 flex items-center justify-center mr-3 group-hover:bg-red-50 group-hover:border-red-100 transition-all">
                <i class="fas fa-arrow-left"></i>
            </div>
            Kembali ke Daftar
        </a>
        <div class="flex items-center space-x-3">
            <span class="text-xs font-black text-gray-300 uppercase tracking-widest">Status:</span>
            <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm 
                {{ $order->status == 'completed' ? 'bg-green-100 text-green-600 border border-green-200' : 
                   ($order->status == 'pending' ? 'bg-orange-100 text-orange-600 border border-orange-200' : 'bg-red-100 text-red-600 border border-red-200') }}">
                {{ $order->status }}
            </span>
        </div>
    </div>

    <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
        <!-- Order Header Information -->
        <div class="p-8 md:p-12 border-b border-gray-50 bg-gray-50/30">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Informasi Pelanggan</h4>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-red-500 flex items-center justify-center text-white text-lg font-black shadow-lg shadow-red-100">
                            {{ substr($order->customer_name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-xl font-black text-gray-800">{{ $order->customer_name }}</div>
                            <div class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Customer ID: #USER-{{ $order->id }}</div>
                        </div>
                    </div>
                </div>
                <div class="md:text-right">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Waktu Transaksi</h4>
                    <div class="text-xl font-black text-gray-800">{{ $order->created_at->format('d M Y') }}</div>
                    <div class="text-xs text-gray-400 font-bold uppercase tracking-tighter">{{ $order->created_at->format('H:i:s') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="p-8 md:p-12">
            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 font-bold">Item Pesanan</h4>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between p-4 rounded-3xl border border-gray-50 hover:bg-gray-50 transition-colors group">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden border border-gray-100">
                            <img src="{{ $item->menu->image_url }}" alt="{{ $item->menu->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="font-bold text-gray-800 group-hover:text-red-500 transition-colors">{{ $item->menu->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $item->menu->category }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 font-bold mb-1">{{ $item->quantity }}x <span class="mx-1">@</span> Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        <div class="font-black text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Totals -->
            <div class="mt-12 pt-8 border-t border-gray-100">
                <div class="flex items-center justify-between p-8 bg-red-500 rounded-[32px] text-white shadow-xl shadow-red-100">
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-1">Total Pembayaran</div>
                        <div class="text-sm font-bold">Metode: Tunai</div>
                    </div>
                    <div class="text-3xl font-black tracking-tight">
                        <span class="text-sm font-normal opacity-70 mr-1">Rp</span>{{ number_format($order->total_amount, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Footer -->
        <div class="p-8 border-t border-gray-50 flex justify-center bg-gray-50/20">
            <button onclick="window.print()" class="px-8 py-3 bg-white border border-gray-100 text-gray-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-gray-50 transition-all flex items-center shadow-sm">
                <i class="fas fa-print mr-2"></i> Cetak Struk
            </button>
        </div>
    </div>
</div>
@endsection

