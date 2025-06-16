<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Розы красные (25 шт)',
                'slug' => 'red-roses',
                'price' => 3500,
                'category_id' => 1,
                'description' => 'Свежие красные розы из Эквадора'
            ],
            [
                'name' => 'Орхидея фаленопсис',
                'price' => 2200,
                'slug' => 'phalaenopsis',
                'category_id' => 2,
                'description' => 'Белая орхидея в керамическом горшке'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
