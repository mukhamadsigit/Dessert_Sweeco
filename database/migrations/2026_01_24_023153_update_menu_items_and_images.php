<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update Choco Banana Bowl image
        DB::table('menus')->where('name', 'Choco Banana Bowl')->update([
            'image' => 'menus/choco_banana_bowl.jpg'
        ]);

        // Update Sweet Berry Crunch to Tropical Lime Coconut Bowl
        DB::table('menus')->where('name', 'Sweet Berry Crunch')->update([
            'name' => 'Tropical Lime Coconut Bowl',
            'price' => 25000,
            'image' => 'menus/tropical_lime_coconut_bowl.jpg'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert Choco Banana Bowl (cannot easily revert image without knowing previous path, assume generic or null, but let's leave it or try to revert if possible)
        // Assuming previous image was possibly null or different. Best effort revert.
        
        // Revert Tropical Lime Coconut Bowl to Sweet Berry Crunch
        DB::table('menus')->where('name', 'Tropical Lime Coconut Bowl')->update([
            'name' => 'Sweet Berry Crunch',
            'price' => 22000, // Reverting to original price seen in screenshot
            // 'image' => ... // Unknown original image path, skipping image revert
        ]);
    }
};
