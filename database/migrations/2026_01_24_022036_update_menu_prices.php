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
        DB::table('menus')->where('name', 'Caramel Custard')->update(['price' => 10000]);
        DB::table('menus')->where('name', 'Coconut Custard')->update(['price' => 20000]);
        DB::table('menus')->where('name', 'Coffee Pudding')->update(['price' => 15000]);
        DB::table('menus')->where('name', 'Vanilla Pudding')->update(['price' => 20000]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('menus')->where('name', 'Caramel Custard')->update(['price' => 19000]);
        DB::table('menus')->where('name', 'Coconut Custard')->update(['price' => 25000]);
        DB::table('menus')->where('name', 'Coffee Pudding')->update(['price' => 17000]);
        DB::table('menus')->where('name', 'Vanilla Pudding')->update(['price' => 25000]);
    }
};
