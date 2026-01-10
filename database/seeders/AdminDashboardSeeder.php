<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboardSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Menus
        $menus = [
            ['name' => 'Nasi Goreng Spesial', 'category' => 'Makanan Utama', 'price' => 25000, 'status' => 'active'],
            ['name' => 'Ayam Bakar Madu', 'category' => 'Makanan Utama', 'price' => 30000, 'status' => 'active'],
            ['name' => 'Es Teh Manis', 'category' => 'Minuman', 'price' => 5000, 'status' => 'active'],
            ['name' => 'Jus Alpukat', 'category' => 'Minuman', 'price' => 15000, 'status' => 'active'],
            ['name' => 'Kentang Goreng', 'category' => 'Cemilan', 'price' => 12000, 'status' => 'active'],
            ['name' => 'Roti Bakar Coklat', 'category' => 'Cemilan', 'price' => 18000, 'status' => 'active'],
            ['name' => 'Kopi Susu Gula Aren', 'category' => 'Kopi', 'price' => 20000, 'status' => 'active'],
            ['name' => 'Mie Goreng Seafood', 'category' => 'Makanan Utama', 'price' => 28000, 'status' => 'active'],
            ['name' => 'Cappuccino', 'category' => 'Kopi', 'price' => 22000, 'status' => 'active'],
            ['name' => 'Burger Sapi', 'category' => 'Makanan Utama', 'price' => 35000, 'status' => 'active'],
        ];

        // Seed Menus and keep IDs
        foreach ($menus as $menuData) {
            Menu::create($menuData);
        }

        // Get all menus
        $allMenus = Menu::all();

        // Helper function to create order with items
        $createOrder = function ($customer, $status, $date) use ($allMenus) {
            $order = Order::create([
                'customer_name' => $customer,
                'total_amount' => 0, // Will update
                'status' => $status,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $total = 0;
            // Add 1-3 random items
            $numItems = rand(1, 3);
            for ($i = 0; $i < $numItems; $i++) {
                $menu = $allMenus->random();
                $qty = rand(1, 2);
                $price = $menu->price; // Snapshot price

                $order->items()->create([
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'price' => $price,
                ]);

                $total += $qty * $price;
            }

            $order->update(['total_amount' => $total]);
        };

        // Seed Orders (Current Date and Past Dates)
        // Today's orders
        $createOrder('Budi Santoso', 'completed', Carbon::now());
        $createOrder('Siti Aminah', 'completed', Carbon::now());
        $createOrder('Rizky Ramadhan', 'pending', Carbon::now());

        // Yesterday's orders
        $createOrder('Dewi Lestari', 'completed', Carbon::yesterday());
        $createOrder('Andi Wijaya', 'completed', Carbon::yesterday());

        // Past orders for chart data
        $createOrder('Fajar Nugraha', 'completed', Carbon::now()->subDays(2));
        $createOrder('Rina Amalia', 'completed', Carbon::now()->subDays(3));
        $createOrder('Doni Saputra', 'completed', Carbon::now()->subDays(4));
        $createOrder('Eka Pratiwi', 'completed', Carbon::now()->subDays(5));
        $createOrder('Gunawan', 'completed', Carbon::now()->subDays(6));
    }
}
