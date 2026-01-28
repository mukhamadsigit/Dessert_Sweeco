<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Gluten Free (GF)
            ['name' => 'Tart Cokelat', 'category' => 'Tart & pie', 'tags' => ['🟢 Gluten Free (GF)']],
            ['name' => 'Peanut Butter Cookies', 'category' => 'Cookies', 'tags' => ['🟢 Gluten Free (GF)']],
            ['name' => 'Almond Cookies', 'category' => 'Cookies', 'tags' => ['🟢 Gluten Free (GF)']],
            ['name' => 'Mixed Fruit Bowl', 'category' => 'Healty Deesert Bowl', 'tags' => ['🟢 Gluten Free (GF)']],
            ['name' => 'Vanilla Pudding', 'category' => 'Pudding & Panacotta', 'tags' => ['🟢 Gluten Free (GF)']],
            ['name' => 'Coconut Custard', 'category' => 'Pudding & Panacotta', 'tags' => ['🟢 Gluten Free (GF)']],

            // Sugar Free (SF)
            ['name' => 'Pai Lemon', 'category' => 'Tart & pie', 'tags' => ['🔵 Sugar Free (SF)']],
            ['name' => 'Dark Chocolate Cookies', 'category' => 'Cookies', 'tags' => ['🔵 Sugar Free (SF)']],
            ['name' => 'Choco Banana Bowl', 'category' => 'Healty Deesert Bowl', 'tags' => ['🔵 Sugar Free (SF)']],

            // Both GF and SF
            ['name' => 'Green Detox Bowl', 'category' => 'Healty Deesert Bowl', 'tags' => ['🟢 Gluten Free (GF)', '🔵 Sugar Free (SF)']],
            ['name' => 'Chia Seed Pudding', 'category' => 'Pudding & Panacotta', 'tags' => ['🟢 Gluten Free (GF)', '🔵 Sugar Free (SF)']],
        ];

        foreach ($items as $item) {
            Menu::updateOrCreate(
                ['name' => $item['name']],
                [
                    'category' => $item['category'],
                    'price' => 25000, 
                    'status' => 'active',
                    'tags' => $item['tags'],
                ]
            );
        }
    }
}
