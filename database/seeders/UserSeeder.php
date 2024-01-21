<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_no' => '8894158773',
            'password' => bcrypt('12345678'),
            'role_id' => 1,
        ]);
    }
}
