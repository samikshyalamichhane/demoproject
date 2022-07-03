<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Super Admin',
            'email' => 'super-admin@hamrodristi.com',
            'password' => bcrypt('secret'),
            'is_admin' =>1
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@hamrodristi.com',
            'password' => bcrypt('secret'),
            'is_admin' =>1
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@hamrodristi.com',
            'password' => bcrypt('secret'),
            'is_admin' =>0
        ]);
    }
}
