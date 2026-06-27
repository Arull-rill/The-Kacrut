<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::updateOrCreate(
            ['email' => 'admin@bandwebsite.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@bandwebsite.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Buat akun user biasa untuk testing
        User::updateOrCreate(
            ['email' => 'user@bandwebsite.com'],
            [
                'name'     => 'User Biasa',
                'email'    => 'user@bandwebsite.com',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ]
        );
    }
}