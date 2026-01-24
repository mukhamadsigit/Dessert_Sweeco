@extends('layouts.admin')

@section('title', 'Daftar Menu')
@section('header_title', 'Daftar Menu')
@section('header_subtitle', 'Kelola katalog produk Anda di sini')

@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.menu.create') }}" class="bg-red-500 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-red-600 transition-all shadow-sm shadow-red-100 flex items-center">
        <i class="fas fa-plus mr-2 text-xs"></i> Tambah Menu
    </a>
</div>

<div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="p-4 border-b border-gray-50">Foto</th>
                        <th class="p-4 border-b border-gray-50">Nama Menu</th>
                        <th class="p-4 border-b border-gray-50">Kategori</th>
                        <th class="p-4 border-b border-gray-50 text-right">Harga</th>
                        <th class="p-4 border-b border-gray-50 text-center">Status App</th>
                        <th class="p-4 border-b border-gray-50 text-center">Status</th>
                        <th class="p-4 border-b border-gray-50 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($menus as $menu)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 overflow-hidden border border-gray-100 shadow-sm group-hover:scale-105 transition-transform">
                                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-800 group-hover:text-red-500 transition-colors">{{ $menu->name }}</div>
                            <div class="text-[10px] text-gray-400">ID: #{{ $menu->id }}</div>
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-[10px] font-bold rounded-lg uppercase">
                                {{ $menu->category }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-800 font-bold text-right">
                            <span class="text-xs font-normal text-gray-400 mr-1">Rp</span>{{ number_format($menu->price, 0, ',', '.') }}
                        </td>
                        <td class="p-4 text-center">
                            @if($menu->is_hot_today)
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase bg-orange-100 text-orange-600 border border-orange-200">
                                <i class="fas fa-fire mr-1"></i>Hot
                            </span>
                            @else
                            <span class="text-gray-300 text-[10px] font-bold uppercase tracking-tighter italic">Regular</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $menu->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                {{ $menu->status }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-gray-400">
                            <i class="fas fa-utensils text-4xl mb-4 opacity-20"></i>
                            <p class="font-medium">Belum ada menu terdaftar</p>
                            <a href="{{ route('admin.menu.create') }}" class="text-red-500 text-sm font-bold mt-2 inline-block hover:underline">Tambah Sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($menus->hasPages())
        <div class="mt-8 px-4">
            {{ $menus->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

