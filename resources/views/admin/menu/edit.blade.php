@extends('layouts.admin')

@section('title', 'Edit Menu')
@section('header_title', 'Edit Menu')
@section('header_subtitle', 'Perbarui detail menu ' . $menu->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 md:p-12">
        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <!-- Image Upload with Preview -->
                <div class="group text-center">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 text-left">Foto Menu</label>
                    <div class="relative inline-block w-full">
                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer block w-full aspect-video bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 group-hover:border-red-200 transition-all overflow-hidden shadow-inner flex items-center justify-center">
                            <img id="image-preview" src="{{ $menu->image_url }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                <div class="text-center">
                                    <i class="fas fa-camera text-2xl mb-2"></i>
                                    <span class="block text-xs font-bold uppercase tracking-widest">Ganti Foto</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Nama Menu</label>
                        <input type="text" name="name" value="{{ $menu->name }}" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white p-4 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all font-bold text-gray-800" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Kategori</label>
                        <select name="category" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white p-4 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all font-bold text-gray-800 appearance-none">
                            <option value="cookies" {{ $menu->category == 'cookies' ? 'selected' : '' }}>cookies</option>
                            <option value="Healty Deesert Bowl" {{ $menu->category == 'Healty Deesert Bowl' ? 'selected' : '' }}>Healty Deesert Bowl</option>
                            <option value="Pudding & Panacotta" {{ $menu->category == 'Pudding & Panacotta' ? 'selected' : '' }}>Pudding & Panacotta</option>
                            <option value="Tart & pie" {{ $menu->category == 'Tart & pie' ? 'selected' : '' }}>Tart & pie</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Harga</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                            <input type="number" name="price" value="{{ $menu->price }}" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white p-4 pl-12 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all font-bold text-gray-800" required>
                        </div>
                    </div>
                </div>

                <!-- Hot Today Toggle -->
                <div class="bg-orange-50/50 rounded-3xl p-6 border border-orange-100 flex items-center justify-between group hover:bg-orange-50 transition-colors">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600">
                            <i class="fas fa-fire text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-orange-800 text-sm">Hot Today</h4>
                            <p class="text-[10px] text-orange-600 font-bold uppercase tracking-tight">Promosikan di halaman utama</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_hot_today" value="1" {{ $menu->is_hot_today ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:start-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500 transition-all"></div>
                    </label>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Status Menu</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="active" class="sr-only peer" {{ $menu->status == 'active' ? 'checked' : '' }}>
                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50 text-center peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 transition-all">
                                <span class="text-xs font-bold uppercase tracking-widest">Active</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="inactive" class="sr-only peer" {{ $menu->status == 'inactive' ? 'checked' : '' }}>
                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50 text-center peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all">
                                <span class="text-xs font-bold uppercase tracking-widest">Inactive</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-4 pt-4">
                    <a href="{{ route('admin.menu.index') }}" class="flex-1 py-4 bg-gray-100 text-gray-400 rounded-3xl font-black uppercase text-xs tracking-widest hover:bg-gray-200 transition-all text-center">Batal</a>
                    <button type="submit" class="flex-1 py-4 bg-red-500 text-white rounded-3xl font-black uppercase text-xs tracking-widest hover:bg-red-600 transition-all shadow-xl shadow-red-100">Update Menu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('image-preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

