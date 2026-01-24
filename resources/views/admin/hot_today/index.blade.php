@extends('layouts.admin')

@section('title', 'Manajemen Hot Today')
@section('header_title', 'Manajemen Hot Today')
@section('header_subtitle', 'Pilih menu yang akan dipromosikan di halaman utama aplikasi')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($menus as $menu)
    <div class="bg-white p-6 rounded-[32px] shadow-sm border border-transparent hover:border-orange-100 transition-all group relative overflow-hidden">
        @if($menu->is_hot_today)
        <div class="absolute -top-4 -right-4 w-12 h-12 bg-orange-500 rotate-45 flex items-end justify-center pb-1">
            <i class="fas fa-fire text-white text-[10px] -rotate-45 mb-1"></i>
        </div>
        @endif
        
        <div class="flex items-center justify-between mb-4">
            <div class="w-16 h-16 rounded-2xl bg-gray-50 overflow-hidden border border-gray-100 group-hover:border-orange-200 transition-all shadow-sm">
                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
            </div>
            <form action="{{ route('admin.hot-today.toggle', $menu->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-10 h-10 rounded-xl transition-all flex items-center justify-center {{ $menu->is_hot_today ? 'bg-orange-500 text-white shadow-lg shadow-orange-100' : 'bg-gray-100 text-gray-400 hover:bg-orange-100 hover:text-orange-500' }}">
                    <i class="fas fa-fire text-sm"></i>
                </button>
            </form>
        </div>
        
        <h3 class="font-bold text-gray-800 text-lg group-hover:text-orange-600 transition-colors">{{ $menu->name }}</h3>
        <p class="text-xs text-gray-400 mb-6 uppercase font-bold tracking-tight">{{ $menu->category }}</p>
        
        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
            <div class="text-gray-800 font-black">
                <span class="text-[10px] font-normal text-gray-400 mr-0.5">Rp</span>{{ number_format($menu->price, 0, ',', '.') }}
            </div>
            <span class="text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-widest {{ $menu->is_hot_today ? 'bg-orange-100 text-orange-600' : 'bg-gray-100 text-gray-300' }}">
                {{ $menu->is_hot_today ? 'Hot Today' : 'Regular' }}
            </span>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-100">
        <i class="fas fa-utensils text-5xl mb-4 text-gray-200 block"></i>
        <p class="font-bold text-gray-400">Belum ada menu terdaftar</p>
        <a href="{{ route('admin.menu.create') }}" class="text-red-500 text-sm font-bold mt-2 inline-block hover:underline">Tambah Menu Sekarang</a>
    </div>
    @endforelse
</div>
@endsection

