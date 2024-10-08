<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(QualitiesSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
