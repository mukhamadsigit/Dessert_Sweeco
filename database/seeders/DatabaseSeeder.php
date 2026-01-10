<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Owner
        User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'role' => 'owner',
            'password' => bcrypt('password'),
        ]);

        // Create Admin (Kasir)
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'kasir',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            AdminDashboardSeeder::class,
        ]);
    }
}
