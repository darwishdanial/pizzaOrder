<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@pizzaplz.com',
                'password' => hash::make(123456),
                'user_type' => 0,
            ],
            [
                'name' => 'Ahmad Ammar',
                'email' => 'ammar@pizzaplz.com',
                'password' =>  hash::make(123456),
                'user_type' => 1,
            ],
            [
                'name' => 'Ahmad Aqil',
                'email' => 'aqil@gmail.com',
                'password' =>  hash::make(123456),
                'user_type' => 2,
            ]

        ]);

    }
}
