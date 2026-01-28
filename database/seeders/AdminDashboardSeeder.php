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
        // Seed Dessert Menus
        $menus = [
            // Cookies Category
            ['name' => 'Almond Cookies', 'category' => 'Cookies', 'price' => 23000, 'image' => 'menus/almond_cookies.jpg', 'status' => 'active'],
            ['name' => 'Choco Chips Cookies', 'category' => 'Cookies', 'price' => 11000, 'image' => 'menus/choco_chips_cookies.jpg', 'status' => 'active'],
            ['name' => 'Dark Chocolate Cookies', 'category' => 'Cookies', 'price' => 23000, 'image' => 'menus/dark_chocolate_cookies.jpg', 'status' => 'active'],
            ['name' => 'Oatmeal Raisin Cookies', 'category' => 'Cookies', 'price' => 11000, 'image' => 'menus/oatmeal_raisin_cookies.jpg', 'status' => 'active'],
            ['name' => 'Peanut Butter Cookies', 'category' => 'Cookies', 'price' => 25000, 'image' => 'menus/peanut_butter_cookies.jpg', 'status' => 'active'],
            ['name' => 'Red Velvet Cookies', 'category' => 'Cookies', 'price' => 17000, 'image' => 'menus/red_velvet_cookies.jpg', 'status' => 'active'],
            
            // Healthy Dessert Bowl Category
            ['name' => 'Green Detox Bowl', 'category' => 'Healty Deesert Bowl', 'price' => 25000, 'image' => 'menus/green_detox_bowl.jpg', 'status' => 'active'],
            ['name' => 'Mixed Fruit Bowl', 'category' => 'Healty Deesert Bowl', 'price' => 25000, 'image' => 'menus/mixed_fruit_bowl.jpg', 'status' => 'active'],
            ['name' => 'Peanut Crunch Bowl', 'category' => 'Healty Deesert Bowl', 'price' => 27000, 'image' => 'menus/peanut_crunch_bowl.jpg', 'status' => 'active'],
            ['name' => 'Tropical Lime Coconut Bowl', 'category' => 'Healty Deesert Bowl', 'price' => 25000, 'image' => 'menus/tropical_lime_coconut_bowl.jpg', 'status' => 'active'],
            ['name' => 'Yogurt Berry Bowl', 'category' => 'Healty Deesert Bowl', 'price' => 23000, 'image' => 'menus/yogurt_berry_bowl.jpg', 'status' => 'active'],
            ['name' => 'Choco Banana Bowl', 'category' => 'Healty Deesert Bowl', 'price' => 25000, 'image' => 'menus/choco_banana_bowl.jpg', 'status' => 'active'],
            
            // Pudding & Panacotta Category
            ['name' => 'Caramel Custard', 'category' => 'Pudding & Panacotta', 'price' => 10000, 'image' => 'menus/caramel_custard.jpg', 'status' => 'active'],
            ['name' => 'Chia Seed Pudding', 'category' => 'Pudding & Panacotta', 'price' => 25000, 'image' => 'menus/chia_seed_pudding.jpg', 'status' => 'active'],
            ['name' => 'Coconut Custard', 'category' => 'Pudding & Panacotta', 'price' => 20000, 'image' => 'menus/coconut_custard.jpg', 'status' => 'active'],
            ['name' => 'Coffee Pudding', 'category' => 'Pudding & Panacotta', 'price' => 15000, 'image' => 'menus/coffee_pudding.jpg', 'status' => 'active'],
            ['name' => 'Vanilla Pudding', 'category' => 'Pudding & Panacotta', 'price' => 20000, 'image' => 'menus/vanilla_pudding.jpg', 'status' => 'active'],
            
            // Tart & Pie Category
            ['name' => 'Kue Tart Stroberi', 'category' => 'Tart & pie', 'price' => 35000, 'image' => 'menus/kue_tart_stroberi.jpg', 'status' => 'active'],
            ['name' => 'Pie Blueberry', 'category' => 'Tart & pie', 'price' => 22000, 'image' => 'menus/pie_blueberry.jpg', 'status' => 'active'],
            ['name' => 'Pie Buah Mini', 'category' => 'Tart & pie', 'price' => 8000, 'image' => 'menus/pie_buah_mini.jpg', 'status' => 'active'],
            ['name' => 'Tart Cokelat', 'category' => 'Tart & pie', 'price' => 45000, 'image' => 'menus/tart_cokelat.jpg', 'status' => 'active'],
            ['name' => 'Tart Kacang Karamel', 'category' => 'Tart & pie', 'price' => 24000, 'image' => 'menus/tart_kacang_karamel.jpg', 'status' => 'active'],
            ['name' => 'Pai Lemon', 'category' => 'Tart & pie', 'price' => 25000, 'image' => 'menus/pai_lemon.jpg', 'status' => 'active'],
        ];

        // Seed Menus and keep IDs
        // Seed Menus and update existing if name matches
        foreach ($menus as $menuData) {
            Menu::updateOrCreate(
                ['name' => $menuData['name']], // Lookup by name
                $menuData
            );
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

        // Past orders for chart dataa
        $createOrder('Fajar Nugraha', 'completed', Carbon::now()->subDays(2));
        $createOrder('Rina Amalia', 'completed', Carbon::now()->subDays(3));
        $createOrder('Doni Saputra', 'completed', Carbon::now()->subDays(4));
        $createOrder('Eka Pratiwi', 'completed', Carbon::now()->subDays(5));
        $createOrder('Gunawan', 'completed', Carbon::now()->subDays(6));
    }
}
