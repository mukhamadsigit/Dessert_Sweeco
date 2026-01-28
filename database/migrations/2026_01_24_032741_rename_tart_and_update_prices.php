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
        // Rename Tart Buah Mini -> Pie Buah Mini and set price to 8000
        $tartBuah = Menu::where('name', 'Tart Buah Mini')->first();
        if ($tartBuah) {
            $tartBuah->update([
                'name' => 'Pie Buah Mini',
                'price' => 8000
            ]);
        }

        // Update Tart Cokelat price to 45000
        $tartCokelat = Menu::where('name', 'Tart Cokelat')->first();
        if ($tartCokelat) {
            $tartCokelat->update([
                'price' => 45000
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
