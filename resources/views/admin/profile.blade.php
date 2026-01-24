@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('header_title', 'Profil Admin')
@section('header_subtitle', 'Kelola informasi akun Anda di sini')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
        <div class="h-32 bg-gradient-to-r from-red-400 to-red-600"></div>
        <div class="px-8 pb-8">
            <div class="relative flex justify-between items-end -mt-12 mb-8">
                <div class="w-24 h-24 rounded-3xl bg-white p-1 shadow-md overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=128" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-2xl">
                </div>
                <div class="pb-1">
                    <span class="px-4 py-1.5 rounded-full bg-green-50 text-green-600 text-xs font-bold uppercase tracking-wider">
                        Account Active
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Pribadi</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Nama Lengkap</label>
                            <div class="text-gray-800 font-medium bg-gray-50 p-3 rounded-xl border border-gray-100">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Alamat Email</label>
                            <div class="text-gray-800 font-medium bg-gray-50 p-3 rounded-xl border border-gray-100">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Akses & Peran</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Peran Pengguna</label>
                            <div class="flex items-center space-x-2 text-red-500 font-bold bg-red-50 p-3 rounded-xl border border-red-100 uppercase text-sm">
                                <i class="fas fa-shield-alt"></i>
                                <span>{{ $user->role }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Tanggal Bergabung</label>
                            <div class="text-gray-800 font-medium bg-gray-50 p-3 rounded-xl border border-gray-100">
                                {{ $user->created_at->format('d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100">
                <div class="flex justify-end space-x-4">
                    <button class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition-colors">
                        Ubah Password
                    </button>
                    <button class="px-6 py-2.5 rounded-xl bg-red-500 text-white text-sm font-semibold hover:bg-red-600 transition-colors shadow-sm shadow-red-200">
                        Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
