<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $cookies = [
            'Almond Cookies', 
            'Choco Chips Cookies', 
            'Dark Chocolate Cookies', 
            'Oatmeal Raisin Cookies', 
            'Peanut Butter Cookies', 
            'Red Velvet Cookies'
        ];

        foreach ($cookies as $name) {
            $menu = Menu::where('name', $name)->first();
            
            if ($menu) {
                // Check if tags contain Gluten Free or Sugar Free
                // $menu->tags is cast to array in model, assuming it's fetched correctly via Eloquent
                // But in migration raw query might be safer if model casts fail, but let's try Eloquent first as we imported App\Models\Menu
                
                $isPremium = false;
                if (!empty($menu->tags)) {
                    foreach ($menu->tags as $tag) {
                        if (stripos($tag, 'Gluten Free') !== false || stripos($tag, 'Sugar Free') !== false) {
                            $isPremium = true;
                            break;
                        }
                    }
                }

                if ($isPremium) {
                    $price = rand(20, 25) * 1000; // 20k - 25k
                } else {
                    $price = rand(10, 18) * 1000; // 10k - 18k
                }

                $menu->update(['price' => $price]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No strict revert needed for randomization, but could set to static defaults if desired.
        // Leaving empty as "randomization" is a forward-only semantic here.
    }
};
