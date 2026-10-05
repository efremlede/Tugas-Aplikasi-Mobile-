<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Semen Kupang 40 kg',
            'brand' => 'Semen Kupang',
            'weight' => 40,
            'price' => 65000,
            'stock' => 100,
            'description' => 'Semen berkualitas untuk berbagai kebutuhan pembangunan.',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Semen Kupang 50 kg',
            'brand' => 'Semen Kupang',
            'weight' => 50,
            'price' => 80000,
            'stock' => 80,
            'description' => 'Semen berkualitas dengan kemasan 50 kg.',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Semen Tiga Roda 40 kg',
            'brand' => 'Tiga Roda',
            'weight' => 40,
            'price' => 70000,
            'stock' => 100,
            'description' => 'Semen Tiga Roda untuk kebutuhan konstruksi.',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Semen Tiga Roda 50 kg',
            'brand' => 'Tiga Roda',
            'weight' => 50,
            'price' => 85000,
            'stock' => 80,
            'description' => 'Semen Tiga Roda kemasan 50 kg.',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Semen Tonasa 40 kg',
            'brand' => 'Tonasa',
            'weight' => 40,
            'price' => 68000,
            'stock' => 90,
            'description' => 'Semen Tonasa untuk pembangunan rumah dan bangunan.',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Semen Tonasa 50 kg',
            'brand' => 'Tonasa',
            'weight' => 50,
            'price' => 83000,
            'stock' => 70,
            'description' => 'Semen Tonasa kemasan 50 kg berkualitas.',
            'image' => null,
        ]);
    }
}