@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('header_title', 'Manajemen User')
@section('header_subtitle', 'Pantau dan kelola user yang terdaftar di aplikasi Sweeco')

@section('content')
<div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="p-4 border-b border-gray-50">User</th>
                        <th class="p-4 border-b border-gray-50">Email</th>
                        <th class="p-4 border-b border-gray-50 text-center">Status</th>
                        <th class="p-4 border-b border-gray-50">Terdaftar Pada</th>
                        <th class="p-4 border-b border-gray-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl bg-gray-100 overflow-hidden shadow-sm group-hover:scale-105 transition-transform">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600 font-medium">
                            {{ $user->email }}
                        </td>
                        <td class="p-4 text-center">
                            <span class="px-3 py-1 text-[10px] font-black rounded-full uppercase tracking-tighter shadow-sm
                                {{ $user->status === 'active' ? 'bg-green-100 text-green-600 border border-green-200' : 'bg-red-100 text-red-600 border border-red-200' }}">
                                {{ $user->status }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-500 text-xs font-medium">
                            {{ $user->created_at->format('d M Y') }}
                            <span class="block text-[10px] text-gray-300">Bergabung</span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-tight transition-all shadow-sm
                                        {{ $user->status === 'active' ? 'bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white border border-orange-100' : 'bg-green-50 text-green-500 hover:bg-green-500 hover:text-white border border-green-100' }}">
                                        {{ $user->status === 'active' ? 'Ban User' : 'Unban User' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-gray-400">
                            <i class="fas fa-users-slash text-4xl mb-4 opacity-20"></i>
                            <p class="font-medium">Belum ada user aplikasi terdaftar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="mt-8 px-4">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

