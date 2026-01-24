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
        User::updateOrCreate(
            ['email' => 'owner@gmail.com'],
            [
                'name' => 'Owner',
                'role' => 'owner',
                'password' => bcrypt('owner123'),
            ]
        );

        // Create Admin (Kasir)
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'role' => 'kasir',
                'password' => bcrypt('password'),
            ]
        );

        $this->call([
            AdminDashboardSeeder::class,
        ]);
    }
}
