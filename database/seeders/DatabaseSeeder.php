<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Pribadi (Admin Toko Semen Jaya)
        User::create([
            'name'              => 'Akun Pribadi POLIJE',
            'email'             => 'e44253240@student.polije.ac.id',
            'email_verified_at' => now(),
            'password'          => Hash::make('password123'),
            'usertype'          => 'admin',
        ]);

        // 2. Akun Kasir Toko Semen Jaya
        User::create([
            'name'              => 'Kasir Semen Jaya',
            'email'             => 'kasir@semenjaya.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password123'),
            'usertype'          => 'kasir',
        ]);

        // 3. Akun Pembeli / User Biasa
        User::create([
            'name'              => 'Pembeli Jaya',
            'email'             => 'pembeli@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password123'),
            'usertype'          => 'pembeli',
        ]);
    }
}