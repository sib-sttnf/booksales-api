<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> bcrypt('adm123'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'password'=> bcrypt('cust123'),
            'role' => 'customer'
        ]);
    }
}
