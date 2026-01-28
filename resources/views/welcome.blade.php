<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sweeco - Sweet Co. Pastry & Desserts</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, .font-serif {
            font-family: 'Playfair Display', serif;
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('/hero.png');
            background-size: cover;
            background-position: center;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-[#FAF9F6] text-[#1a1a1a]">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center text-white">
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <!-- Nav Links - Desktop -->
            <div class="hidden lg:flex items-center space-x-12 font-medium ml-12">
                <a href="#home" class="hover:text-red-400 transition duration-300">Beranda</a>
                <a href="#favorit" class="hover:text-red-400 transition duration-300">Favorit</a>
                <a href="#tentang" class="hover:text-red-400 transition duration-300">Tentang</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-2 bg-white/10 text-white border border-white/20 rounded-full font-bold hover:bg-white/20 transition">Login</a>
                @auth
                    @if(auth()->user()->role === 'user')
                        <a href="{{ url('/user') }}" class="px-8 py-2.5 bg-red-500 text-white rounded-full font-bold hover:bg-red-600 transition shadow-lg shadow-red-500/20">Dashboard</a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="px-8 py-2.5 bg-red-500 text-white rounded-full font-bold hover:bg-red-600 transition shadow-lg shadow-red-500/20">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="px-8 py-2.5 bg-red-500 text-white rounded-full font-bold hover:bg-red-600 transition shadow-lg shadow-red-500/20">Daftar</a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden lg:hidden bg-black/80 backdrop-blur-xl border-t border-white/10 text-white p-6 space-y-4 font-medium transition-all duration-300">
            <a href="#home" class="block py-4 border-b border-white/5">Beranda</a>
            <a href="#favorit" class="block py-4 border-b border-white/5">Favorit</a>
            <a href="#tentang" class="block py-4">Tentang</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center hero-section pt-20">
        <div class="max-w-7xl mx-auto px-6 w-full text-center lg:text-left">
            <div class="max-w-3xl text-white">
                <span class="inline-block px-4 py-1 bg-red-500/20 backdrop-blur-md border border-red-500/30 rounded-full text-red-400 text-sm font-bold mb-6">MENGGUGAH SELERA SEJAK 2026</span>
                <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold mb-8 leading-tight">Keajaiban di <br>Setiap <span class="text-red-400">Gigitan.</span></h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-xl leading-relaxed mx-auto lg:mx-0">Nikmati perpaduan rasa premium dari bahan-bahan pilihan yang diracik khusus untuk memanjakan lidah Anda. Dari kue artisan hingga pastry yang lembut.</p>
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('login') }}" class="px-10 py-5 bg-red-500 text-center text-white rounded-full text-lg font-bold hover:bg-red-600 transition shadow-xl shadow-red-600/40 transform hover:scale-105">Masuk Pelanggan</a>
                    <a href="{{ route('login') }}" class="px-10 py-5 bg-white/10 backdrop-blur-md text-center text-white border border-white/20 rounded-full text-lg font-bold hover:bg-white/20 transition transform hover:scale-105">Portal Admin</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Favorit Section (Hot Today) -->
    <section id="favorit" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24">
                <span class="text-red-500 font-black tracking-[0.2em] text-xs uppercase mb-4 block">Our Speciality</span>
                <h2 class="text-5xl md:text-6xl font-bold mb-6">Menu Favorit Hari Ini</h2>
                <div class="w-32 h-1.5 bg-red-500 mx-auto rounded-full"></div>
                <p class="text-gray-500 mt-10 max-w-2xl mx-auto italic text-lg leading-relaxed">Pilihan terbaik yang paling banyak dinikmati oleh pelanggan setia Sweeco hari ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($hotToday as $item)
                <div class="group bg-[#FAF9F6] rounded-[40px] overflow-hidden border border-gray-100 hover:shadow-2xl hover:-translate-y-3 transition duration-500">
                    <div class="relative h-80 overflow-hidden">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute top-6 left-6 px-4 py-1.5 bg-white/90 backdrop-blur shadow-xl rounded-full text-xs font-black text-red-500 uppercase tracking-widest">{{ $item->category }}</div>
                        <div class="absolute bottom-6 left-6 right-6 p-4 bg-black/20 backdrop-blur-md rounded-2xl border border-white/20 opacity-0 group-hover:opacity-100 transition duration-300">
                            <p class="text-white text-sm font-medium text-center">Bahan pilihan berkualitas tinggi</p>
                        </div>
                    </div>
                    <div class="p-10 text-center">
                        <h3 class="text-3xl font-bold mb-3">{{ $item->name }}</h3>
                        <p class="text-gray-400 text-sm mb-8 leading-relaxed">Dibuat dengan resep rahasia yang menghasilkan cita rasa sempurna.</p>
                        <div class="flex justify-between items-center border-t border-gray-100 pt-8">
                            <span class="text-2xl font-bold text-red-500">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            <a href="{{ route('login') }}" class="px-6 py-2 bg-gray-900 text-white rounded-full text-sm font-bold hover:bg-red-500 transition shadow-lg">Pesan</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-32 bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 italic text-xl">Nantikan kejutan rasa hari ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-32 bg-[#FAF9F6] overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2 relative">
                    <div class="absolute -top-10 -left-10 w-64 h-64 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse"></div>
                    <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse delay-700"></div>
                    <img src="/hero.png" alt="Sweeco Kitchen" class="relative rounded-[60px] shadow-2xl z-10 w-full object-cover aspect-square">
                    <div class="absolute -bottom-8 -left-8 bg-white p-10 rounded-[40px] shadow-2xl z-20 hidden md:block border border-gray-50 transform -rotate-3">
                        <p class="text-4xl font-bold text-red-500 mb-1">100%</p>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Bahan Alami</p>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <span class="text-red-500 font-black tracking-[0.2em] text-xs uppercase mb-6 block">The Story of Sweeco</span>
                    <h2 class="text-5xl md:text-6xl font-bold mb-10 leading-tight">Seni Mengolah <br><span class="text-red-400">Kebahagiaan.</span></h2>
                    <p class="text-xl text-gray-500 mb-8 leading-relaxed italic">"Bagi kami, setiap hidangan adalah sebuah mahakarya yang menceritakan gairah dalam mengolah rasa."</p>
                    <p class="text-gray-600 mb-10 leading-loose">Berdiri sejak awal 2026, Sweeco (Sweet Company) hadir untuk mendefinisikan ulang pengalaman menikmati hidangan penutup. Kami percaya bahwa kualitas bahan adalah kunci utama, itulah sebabnya kami hanya menggunakan butter premium, cokelat artisan, dan buah-buahan segar setiap harinya.</p>
                    
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        <div class="p-6 bg-white rounded-3xl shadow-sm border border-gray-50">
                            <h4 class="font-bold text-gray-900 mb-2 underline decoration-red-400 decoration-4">Visi Kami</h4>
                            <p class="text-sm text-gray-500 leading-relaxed">Menjadi pionir dalam industri pastry modern yang mengutamakan cita rasa autentik.</p>
                        </div>
                        <div class="p-6 bg-white rounded-3xl shadow-sm border border-gray-50">
                            <h4 class="font-bold text-gray-900 mb-2 underline decoration-red-400 decoration-4">Misi</h4>
                            <p class="text-sm text-gray-500 leading-relaxed">Menciptakan momen-momen manis yang tak terlupakan melalui inovasi resep setiap musim.</p>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="inline-flex items-center text-red-500 font-bold text-xl hover:underline underline-offset-8">
                        Jelajahi Dunia Manis Kami
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-24">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-20">
            <div class="col-span-1 md:col-span-2">
                <div class="text-4xl font-bold tracking-tight mb-8">SWEEC<span class="text-red-400">O</span></div>
                <p class="text-gray-400 max-w-sm mb-10 leading-loose">Pusat hidangan penutup dan pastry premium. Kami melayani dengan cinta untuk momen manis Anda setiap waktu.</p>
                <div class="flex space-x-6">
                    <a href="#" class="w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center hover:bg-red-500 transition-all duration-300 transform hover:rotate-12"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center hover:bg-red-500 transition-all duration-300 transform hover:rotate-12"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-8">Eksplorasi</h4>
                <ul class="space-y-5 text-gray-400 font-medium">
                    <li><a href="#home" class="hover:text-white transition">Beranda Utama</a></li>
                    <li><a href="#favorit" class="hover:text-white transition">Menu Terfavorit</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Pesan Online</a></li>
                    <li><a href="#tentang" class="hover:text-white transition">Kisah Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-8">Kontak</h4>
                <p class="text-gray-400 mb-6 leading-relaxed">Jl. Manis No. 123, <br>Kota Dessert, Indonesia 12345</p>
                <p class="text-red-400 font-bold mb-2">0812-3456-7890</p>
                <p class="text-gray-500 text-xs italic mt-8">Buka setiap hari <br>08:00 - 22:00 WIB</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-20 pt-10 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm italic">
            <p>&copy; 2026 Sweeco. Terinspirasi oleh cinta.</p>
            <div class="flex space-x-8 mt-6 md:mt-0">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Close menu when clicking links
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });
    </script>
</body>
</html>
