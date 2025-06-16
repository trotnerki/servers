<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Букеты', 'slug' => 'bouquets'],
            ['name' => 'Комнатные растения', 'slug' => 'houseplants'],
            ['name' => 'Свадебная флористика', 'slug' => 'wedding'],
            ['name' => 'Горшечные растения', 'slug' => 'potted'],
            ['name' => 'Экзотические цветы', 'slug' => 'exotic']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
