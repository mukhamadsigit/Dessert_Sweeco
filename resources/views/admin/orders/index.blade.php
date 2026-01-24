@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('header_title', 'Riwayat Pesanan')
@section('header_subtitle', 'Pantau dan kelola semua transaksi masuk')

@section('content')
<div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="p-4 border-b border-gray-50">ID Order</th>
                        <th class="p-4 border-b border-gray-50">Pelanggan</th>
                        <th class="p-4 border-b border-gray-50 text-right">Total</th>
                        <th class="p-4 border-b border-gray-50 text-center">Status</th>
                        <th class="p-4 border-b border-gray-50">Waktu Transaksi</th>
                        <th class="p-4 border-b border-gray-50 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-4">
                            <span class="font-bold text-gray-400 group-hover:text-red-500 transition-colors">#{{ $order->id }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-xs font-bold ring-2 ring-white shadow-sm">
                                    {{ substr($order->customer_name, 0, 1) }}
                                </div>
                                <div class="font-bold text-gray-800">{{ $order->customer_name }}</div>
                            </div>
                        </td>
                        <td class="p-4 text-gray-800 font-bold text-right">
                            <span class="text-xs font-normal text-gray-400 mr-1">Rp</span>{{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="p-4 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase 
                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-600 border border-green-200' : 
                                   ($order->status == 'pending' ? 'bg-orange-100 text-orange-600 border border-orange-200' : 'bg-red-100 text-red-600 border border-red-200') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-500 text-xs font-medium">
                            {{ $order->created_at->format('d M Y') }}
                            <span class="block text-[10px] text-gray-300">{{ $order->created_at->format('H:i') }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center px-4 py-1.5 bg-gray-50 text-gray-600 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-all">
                                <i class="fas fa-eye mr-2"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-gray-400">
                            <i class="fas fa-shopping-bag text-4xl mb-4 opacity-20"></i>
                            <p class="font-medium">Belum ada pesanan masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="mt-8 px-4">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

