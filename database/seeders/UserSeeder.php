<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'maulana',
            'email' => 'maulana@gmail.com',
            'password' => bcrypt('password'),
            'role' => 1,
        ]);
        User::create([
            'name' => 'fajar',
            'email' => 'fajar@gmail.com',
            'password' => bcrypt('password'),
            'role' => 2,
        ]);
        User::create([
            'name' => 'ibrahim',
            'email' => 'ibrahim@gmail.com',
            'password' => bcrypt('password'),
            'role' => 3,
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'role' => 4,
        ]);
    }
}
