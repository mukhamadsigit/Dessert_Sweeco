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
            ['email' => 'owner@sweeco.com'],
            [
                'name' => 'Owner Sweeco',
                'role' => 'owner',
                'password' => bcrypt('password'),
                'status' => 'active',
            ]
        );

        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@sweeco.com'],
            [
                'name' => 'Admin Sweeco',
                'role' => 'admin',
                'password' => bcrypt('password'),
                'status' => 'active',
            ]
        );

        // Create Kasir
        User::updateOrCreate(
            ['email' => 'kasir@sweeco.com'],
            [
                'name' => 'Kasir Sweeco',
                'role' => 'kasir',
                'password' => bcrypt('password'),
                'status' => 'active',
            ]
        );

        // Create Regular User
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Biasa',
                'role' => 'user',
                'password' => bcrypt('password'),
                'status' => 'active',
            ]
        );

        $this->call([
            AdminDashboardSeeder::class,
            MenuLabelSeeder::class,
        ]);
    }
}
