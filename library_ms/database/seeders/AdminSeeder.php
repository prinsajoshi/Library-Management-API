<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),  // Encoding the password
                'role' => 'admin',
                'token' => Str::random(32),  // Generate a 32-character random token
                'email' => 'admin@gmail.com',
               
            ]
        ]);
    }
}
