<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'value' => 'Салат',
            'slug' => 'salad'
        ]);
        Category::create([
            'value' => 'Второе блюдо',
            'slug' => 'main-course'
        ]);
        Category::create([
            'value' => 'Суп',
            'slug' => 'soup'
        ]);
        Category::create([
            'value' => 'Закуска',
            'slug' => 'snack'
        ]);
        Category::create([
            'value' => 'Мясо',
            'slug' => 'meat'
        ]);
        Category::create([
            'value' => 'Рыба',
            'slug' => 'fish'
        ]);
    }
}
