<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make('user'),
                'birth_date' => '2000-01-01',
                'telephone' => '123456789',
                'role_id' => 1
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'birth_date' => '2000-01-01',
                'telephone' => '123456789',
                'role_id' => 2
            ],
            [
                'name' => 'artist',
                'email' => 'artist@artist.com',
                'password' => Hash::make('artist'),
                'birth_date' => '2000-01-01',
                'telephone' => '123456789',
                'role_id' => 3
            ]
        ]);
    }
}
