<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            User::create([
                'name' => 'user'.$i,
                'role' => 'user',
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => 'admin'.$i,
                'role' => 'admin',
            ]);
        }
    }
}
