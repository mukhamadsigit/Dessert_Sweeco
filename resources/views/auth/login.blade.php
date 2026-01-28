<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sweeco</title>
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

    <div class="bg-white/90 backdrop-blur-xl rounded-[40px] shadow-2xl w-full max-w-md overflow-hidden border border-white/20">
        <div class="p-10">
            <div class="text-center mb-10">
                <a href="/" class="text-4xl font-bold text-gray-900 mb-4 inline-block tracking-tight">SWEEC<span class="text-red-500">O</span></a>
                <p id="login-description" class="text-gray-500 font-medium">Selamat datang kembali! Silakan login untuk melanjutkan.</p>
            </div>

            <!-- Role Selection -->
            <div id="role-selection" class="space-y-4">
                <p class="text-center text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Masuk Sebagai</p>
                
                <button onclick="selectRole('user')" class="w-full p-6 bg-white border border-gray-100 rounded-3xl flex items-center space-x-5 hover:border-red-500 hover:bg-red-50/30 transition-all duration-300 group shadow-sm">
                    <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-red-500 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-gray-900 group-hover:text-red-500 transition-colors">Pelanggan</h4>
                        <p class="text-xs text-gray-400 font-medium">Pesan dessert favoritmu</p>
                    </div>
                </button>

                <button onclick="selectRole('admin')" class="w-full p-6 bg-white border border-gray-100 rounded-3xl flex items-center space-x-5 hover:border-gray-900 hover:bg-gray-50 transition-all duration-300 group shadow-sm">
                    <div class="w-14 h-14 bg-gray-50 text-gray-400 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-gray-900 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h4 class="font-bold text-gray-900 group-hover:text-gray-900 transition-colors">Admin / Staff</h4>
                        <p class="text-xs text-gray-400 font-medium">Kelola toko dan pesanan</p>
                    </div>
                </button>
            </div>

            <!-- Login Form (Initially Hidden) -->
            <div id="login-form-container" class="hidden">
                <button onclick="showSelection()" class="flex items-center text-xs font-bold text-gray-400 hover:text-red-500 transition mb-6 uppercase tracking-widest group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </button>

                @if($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-8 text-sm font-semibold border border-red-100 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_type" id="role_type_input" value="user">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 pl-1">Email Address</label>
                            <input type="email" name="email" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 font-medium" placeholder="nama@email.com" required>
                        </div>

                        <div>
                            <div class="flex justify-between items-end mb-2 pl-1">
                                <label class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Password</label>
                                <a href="#" class="text-[10px] font-bold text-red-500 hover:text-red-600 uppercase tracking-widest">Lupa Password?</a>
                            </div>
                            <input type="password" name="password" class="w-full rounded-2xl border-gray-100 bg-gray-50/50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300" placeholder="••••••••" required>
                        </div>

                        <button id="submit-btn" type="submit" class="w-full py-5 bg-red-500 text-white rounded-2xl font-bold hover:bg-red-600 transition-all duration-300 shadow-xl shadow-red-500/30 transform hover:scale-[1.02] active:scale-[0.98]">
                            Masuk Sekarang
                        </button>
                        
                        <div id="register-link" class="text-center pt-4">
                            <p class="text-gray-400 text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-red-500 font-bold hover:underline">Daftar</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-gray-900/5 p-6 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">
            &copy; 2026 Sweeco Management System
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role-selection').classList.add('hidden');
            document.getElementById('login-form-container').classList.remove('hidden');
            document.getElementById('role_type_input').value = role;
            
            const desc = document.getElementById('login-description');
            const submitBtn = document.getElementById('submit-btn');
            const registerLink = document.getElementById('register-link');
            
            if (role === 'admin') {
                desc.innerText = 'Silakan masuk ke sistem manajemen Sweeco.';
                submitBtn.classList.replace('bg-red-500', 'bg-gray-900');
                submitBtn.classList.replace('hover:bg-red-600', 'hover:bg-black');
                submitBtn.classList.replace('shadow-red-500/30', 'shadow-gray-900/30');
                registerLink.classList.add('hidden');
            } else {
                desc.innerText = 'Nikmati dessert pilihanmu dengan login terlebih dahulu.';
                submitBtn.classList.replace('bg-gray-900', 'bg-red-500');
                submitBtn.classList.replace('hover:bg-black', 'hover:bg-red-600');
                submitBtn.classList.replace('shadow-gray-900/30', 'shadow-red-500/30');
                registerLink.classList.remove('hidden');
            }
        }

        function showSelection() {
            document.getElementById('role-selection').classList.remove('hidden');
            document.getElementById('login-form-container').classList.add('hidden');
            document.getElementById('login-description').innerText = 'Selamat datang kembali! Silakan login untuk melanjutkan.';
        }

        // Keep form visible if there are validation errors
        @if($errors->any())
            document.getElementById('role-selection').classList.add('hidden');
            document.getElementById('login-form-container').classList.remove('hidden');
        @endif
    </script>

</body>
</html>
