<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// ...existing code...
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'joao@example.com'],
            ['name' => 'João Silva', 'password' => Hash::make('password'), 'role' => 0]
        );

        User::updateOrCreate(
            ['email' => 'maria@example.com'],
            ['name' => 'Maria Santos', 'password' => Hash::make('password'), 'role' => 0]
        );

        User::updateOrCreate(
            ['email' => 'pedro@example.com'],
            ['name' => 'Pedro Oliveira', 'password' => Hash::make('password'), 'role' => 0]
        );
    }
}
