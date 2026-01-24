@extends('layouts.admin')

@section('title', 'Tambah Menu')
@section('header_title', 'Tambah Menu Baru')
@section('header_subtitle', 'Masukkan detail menu untuk katalog produk Anda')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-8 md:p-12">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <!-- Image Upload -->
                <div class="group">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Foto Menu</label>
                    <div class="relative">
                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer block w-full aspect-video bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 group-hover:border-red-200 group-hover:bg-red-50/30 transition-all flex flex-col items-center justify-center text-gray-400 overflow-hidden" id="preview-label">
                            <div id="no-preview" class="flex flex-col items-center">
                                <i class="fas fa-cloud-upload-alt text-3xl mb-3"></i>
                                <span class="text-sm font-bold">Klik untuk upload foto</span>
                                <span class="text-[10px] uppercase font-black tracking-tighter mt-1">PNG, JPG, JPEG (Maks. 2MB)</span>
                            </div>
                            <img id="image-preview" class="hidden w-full h-full object-cover">
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Nama Menu</label>
                        <input type="text" name="name" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white p-4 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all font-bold text-gray-800" placeholder="Kopi Susu Gula Aren" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Kategori</label>
                        <select name="category" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white p-4 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all font-bold text-gray-800 appearance-none">
                            <option value="Food">Makanan</option>
                            <option value="Drink">Minuman</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Harga</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                            <input type="number" name="price" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white p-4 pl-12 focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all font-bold text-gray-800" placeholder="15000" required>
                        </div>
                    </div>
                </div>

                <!-- Hot Today -->
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
                        <input type="checkbox" name="is_hot_today" value="1" class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:start-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                    </label>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 font-bold">Status Menu</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="active" class="sr-only peer" checked>
                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50 text-center peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 transition-all">
                                <span class="text-xs font-bold uppercase tracking-widest">Active</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="inactive" class="sr-only peer">
                            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50 text-center peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all">
                                <span class="text-xs font-bold uppercase tracking-widest">Inactive</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-4 pt-4">
                    <a href="{{ route('admin.menu.index') }}" class="flex-1 py-4 bg-gray-100 text-gray-400 rounded-3xl font-black uppercase text-xs tracking-widest hover:bg-gray-200 transition-all text-center">Batal</a>
                    <button type="submit" class="flex-1 py-4 bg-red-500 text-white rounded-3xl font-black uppercase text-xs tracking-widest hover:bg-red-600 transition-all shadow-xl shadow-red-100">Simpan Menu</button>
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
            const noPreview = document.getElementById('no-preview');
            const label = document.getElementById('preview-label');
            
            output.src = reader.result;
            output.classList.remove('hidden');
            noPreview.classList.add('hidden');
            label.classList.remove('bg-gray-50', 'border-dashed');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

