<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'olga@adt.ru',
            'password' => bcrypt('SuperSecretPassword'),
            'email_verified_at' => now(),
            'role_id' => Role::first()->id, // Administrator
        ]);
        User::create([
            'name' => 'adt',
            'email' => 'adt@adt.ru',
            'password' => bcrypt('SuperSecretPassword'),
            'email_verified_at' => now(),
            'role_id' => Role::skip(1)->first()->id, // Moderator
        ]);
        User::create([
            'name' => 'sigva',
            'email' => 'sigva@yandex.ru',
            'password' => bcrypt('SuperSecretPassword'),
            'email_verified_at' => now(),
            'role_id' => Role::skip(1)->first()->id, // Author
        ]);
    }
}
