<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipy;
use App\Models\Quality;

class QualitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quality::create(['name' => 'Вегетарианское']);
        Quality::create(['name' => 'Без глютена']);
        Quality::create(['name' => 'Без лактозы']);
        Quality::create(['name' => 'Низкокалорийное']);
        Quality::create(['name' => 'Высококалорийное']);
    }
}
