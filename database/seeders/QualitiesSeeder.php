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
            'value' => $name = 'Вегетарианское',
            'slug' => Str::slug($name)
            ]);
        Quality::create([
            'value' => $name = 'Без глютена',
            'slug' => Str::slug($name)
        ]);
        Quality::create([
            'value' => $name = 'Без лактозы',
            'slug' => Str::slug($name)
        ]);
        Quality::create([
            'value' => $name = 'Низкокалорийное',
            'slug' => Str::slug($name)
        ]);
        Quality::create([
            'value' => $name = 'Высококалорийное',
            'slug' => Str::slug($name)
        ]);
    }
}
