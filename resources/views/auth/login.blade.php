<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
             theme: {
                extend: {
                    colors: {
                        red: { 50: '#fef2f2', 100: '#fee2e2', 400: '#f87171', 500: '#ef4444', 600: '#dc2626' }
                    },
                    fontFamily: { sans: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
    <style> body { font-family: 'Outfit', sans-serif; background-color: #FDF6F0; } </style>
</head>
<body class="bg-[#FDF6F0] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-3xl shadow-lg w-full max-w-md overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-red-500 mb-2">Sweeco.</h1>
                <p class="text-gray-400">Silakan login untuk masuk ke dashboard</p>
            </div>

            @if($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm font-medium border border-red-100">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" class="w-full rounded-xl border-gray-200 bg-gray-50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="admin@sweeco.com" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full rounded-xl border-gray-200 bg-gray-50 p-4 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="w-full py-4 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition-colors shadow-lg shadow-red-200">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
        <div class="bg-gray-50 p-4 text-center text-xs text-gray-400">
            &copy; 2026 Sweeco Admin System
        </div>
    </div>

</body>
</html>
