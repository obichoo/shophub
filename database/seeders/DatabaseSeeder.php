<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Aubin Admin',
            'email' => 'aubin@mail.com',
            'password' => Hash::make('smice'),
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

    }
}
