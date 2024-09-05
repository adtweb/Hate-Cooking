<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Салат']);
        Category::create(['name' => 'Второе блюдо']);
        Category::create(['name' => 'Суп']);
        Category::create(['name' => 'Закуска']);
        Category::create(['name' => 'Мясо']);
        Category::create(['name' => 'Рыба']);
    }
}
