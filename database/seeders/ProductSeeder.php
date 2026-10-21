<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'semen Kupang 40 kg',
                'category' => 'Semen',
                'price' => 65000,
                'stock' => 50,
                'image' => 'semen-kupang.jpg',
            ],
            [
                'name' => 'Semen Tiga Roda 50kg',
                'category' => 'Semen',
                'price' => 84971,
                'stock' => 50,
                'image' => 'tiga-roda.jpg',
            ],
            [
                'name' => 'Dynamix 50 kg',
                'category' => 'Semen',
                'price' => 65000,
                'stock' => 18,
                'image' => 'dynamix.jpg',
            ],
            [
                'name' => 'Semen Padang 40 kg',
                'category' => 'Semen',
                'price' => 55000,
                'stock' => 50,
                'image' => 'semen-padang.jpg',
            ],
            [
                'name' => 'Semen Putih Tiga Roda 40 kg',
                'category' => 'Semen',
                'price' => 100000,
                'stock' => 46,
                'image' => 'semen-putih.jpg',
            ],
        ];

        foreach ($products as $item) {
            DB::table('products')->updateOrInsert(
                ['name' => $item['name']],
                [
                    'category' => $item['category'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image' => $item['image'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}