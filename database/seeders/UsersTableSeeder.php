<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Maulana Fajar Ibrahim',
            'username' => 'mafi3108',
            'password' => bcrypt('users123'),
            'email' => 'maulanafajaribrahim@gmail.com',
        ]);
    }
}
