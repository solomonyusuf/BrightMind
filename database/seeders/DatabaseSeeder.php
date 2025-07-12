<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'image' => 'https://img.icons8.com/?size=100&id=undefined&format=png&color=000000',
            'first_name' => 'Instructure',
            'last_name' => 'Sarah',
            'role'=> 'instructor',
            'email'=> 'instructor@brightmind.com',
            'password'=> bcrypt(12345)
        ]); 
    }
}
