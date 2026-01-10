<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - #{{ $order->id }}</title>
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
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FDF6F0;
        }
    </style>
</head>
<body class="bg-[#FDF6F0] min-h-screen p-8">

    <div class="max-w-4xl mx-auto">
        <a href="/dashboard" class="inline-flex items-center text-gray-500 hover:text-red-500 mb-6 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <!-- Header -->
            <div class="p-8 border-b border-gray-100 flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Order #{{ $order->id }}</h1>
                    <div class="text-gray-500">Pelanggan: <span class="font-medium text-gray-800">{{ $order->customer_name }}</span></div>
                    <div class="text-gray-500">Tanggal: <span class="font-medium text-gray-800">{{ $order->created_at->format('d F Y, H:i') }}</span></div>
                </div>
                <div>
                    @if($order->status == 'completed')
                        <span class="px-4 py-2 bg-green-100 text-green-600 rounded-xl font-bold text-sm">Selesai</span>
                    @elseif($order->status == 'pending')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-600 rounded-xl font-bold text-sm">Pending</span>
                    @else
                        <span class="px-4 py-2 bg-red-100 text-red-600 rounded-xl font-bold text-sm">{{ ucfirst($order->status) }}</span>
                    @endif
                </div>
            </div>

            <!-- Items -->
            <div class="p-8">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Item Pesanan</h2>
                <div class="border rounded-2xl overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 text-sm">
                            <tr>
                                <th class="p-4 font-medium">Menu</th>
                                <th class="p-4 font-medium text-center">Jumlah</th>
                                <th class="p-4 font-medium text-right">Harga Satuan</th>
                                <th class="p-4 font-medium text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="p-4">
                                    <div class="font-medium text-gray-800">{{ $item->menu->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->menu->category }}</div>
                                </td>
                                <td class="p-4 text-center text-gray-600">{{ $item->quantity }}</td>
                                <td class="p-4 text-right text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="p-4 text-right font-medium text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-red-50">
                            <tr>
                                <td colspan="3" class="p-4 text-right font-bold text-red-500">Total Pembayaran</td>
                                <td class="p-4 text-right font-bold text-red-600 text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
