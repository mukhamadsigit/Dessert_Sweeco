<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Sweeco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        red: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #FDF6F0; }
    </style>
</head>
<body class="bg-[#FDF6F0] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-3xl shadow-sm w-full max-w-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Menu</h2>

        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                    <input type="text" name="name" value="{{ $menu->name }}" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="Food" {{ $menu->category == 'Food' ? 'selected' : '' }}>Makanan</option>
                        <option value="Drink" {{ $menu->category == 'Drink' ? 'selected' : '' }}>Minuman</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $menu->price }}" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                </div>

                <div class="flex items-center space-x-3 bg-orange-50 p-4 rounded-2xl border border-orange-100">
                    <input type="checkbox" name="is_hot_today" id="is_hot_today" value="1" {{ $menu->is_hot_today ? 'checked' : '' }} class="w-5 h-5 rounded text-orange-500 focus:ring-orange-500">
                    <label for="is_hot_today" class="text-sm font-bold text-orange-700">Tampilkan sebagai "Hot Today"</label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="active" {{ $menu->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $menu->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="flex space-x-3 pt-4">
                    <a href="{{ route('admin.menu.index') }}" class="flex-1 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold text-center hover:bg-gray-200 transition-colors">Batal</a>
                    <button type="submit" class="flex-1 py-3 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition-colors">Update</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
