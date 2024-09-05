<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quality;
use Illuminate\Support\Str;

class QualitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quality::create([
            'value' => 'Вегетарианское',
            'slug' => 'vegetarian'
            ]);
        Quality::create([
            'value' => 'Без глютена',
            'slug' => 'gluten-free'
        ]);
        Quality::create([
            'value' => $name = 'Без лактозы',
            'slug' => 'lactose-free'
        ]);
        Quality::create([
            'value' => $name = 'Низкокалорийное',
            'slug' => 'low-calorie'
        ]);
        Quality::create([
            'value' => $name = 'Высококалорийное',
            'slug' => 'high-calorie'
        ]);
    }
}
