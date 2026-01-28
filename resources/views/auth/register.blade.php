<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/hero.png');
            background-size: cover;
            background-position: center;
        } 
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="bg-white/90 backdrop-blur-xl rounded-[40px] shadow-2xl w-full max-w-md overflow-hidden border border-white/20 my-10">
        <div class="p-10">
            <div class="text-center mb-10">
                <a href="/" class="text-4xl font-bold text-gray-900 mb-4 inline-block tracking-tight">SWEEC<span class="text-red-500">O</span></a>
                <p class="text-gray-500 font-medium">Buat akun untuk mulai menikmati hidangan terbaik kami.</p>
            </div>

            @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-8 text-sm font-semibold border border-red-100">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 pl-1">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 font-medium" placeholder="Nama Anda" value="{{ old('name') }}" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 pl-1">Email</label>
                        <input type="email" name="email" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 font-medium" placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 pl-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 font-medium" placeholder="Masukkan alamat lengkap Anda" required>{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 pl-1">Password</label>
                        <input type="password" name="password" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300" placeholder="••••••••" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 pl-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="w-full py-5 bg-red-500 text-white rounded-2xl font-bold hover:bg-red-600 transition-all duration-300 shadow-xl shadow-red-500/30 transform hover:scale-[1.02] active:scale-[0.98]">
                        Daftar Akun
                    </button>
                    
                    <div class="text-center pt-4">
                        <p class="text-gray-400 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-red-500 font-bold hover:underline">Login</a></p>
                    </div>
                </div>
            </form>
        </div>
        <div class="bg-gray-900/5 p-6 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">
            &copy; 2026 Sweeco Management System
        </div>
    </div>

</body>
</html>
