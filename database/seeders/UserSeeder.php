<?php

namespace Database\Seeders;

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

        $user = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        $user = \App\Models\User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);

        $user = \App\Models\User::create([
            'name' => 'eslam',
            'email' => 'elsam@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);


    }
}
