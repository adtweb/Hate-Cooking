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
            'value' => $name = 'Салат',
            'slug' => Str::slug($name)
        ]);
        Category::create([
            'value' => $name = 'Второе блюдо',
            'slug' => Str::slug($name)
        ]);
        Category::create([
            'value' => $name = 'Суп',
            'slug' => Str::slug($name)
        ]);
        Category::create([
            'value' => $name = 'Закуска',
            'slug' => Str::slug($name)
        ]);
        Category::create([
            'value' => $name = 'Мясо',
            'slug' => Str::slug($name)
        ]);
        Category::create([
            'value' => $name = 'Рыба',
            'slug' => Str::slug($name)
        ]);
    }
}
