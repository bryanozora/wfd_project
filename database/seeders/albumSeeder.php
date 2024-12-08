<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class albumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('album')->insert([
            [
                'artist_id' => 3,
                'name' => 'Album 1',
                'photo' => 'photo1.jpg',
                'description' => 'Description 1',
                'price' => 100000,
                'stock' => 10,
                'status' => true
            ],
            [
                'artist_id' => 3,
                'name' => 'Album 2',
                'photo' => 'photo2.jpg',
                'description' => 'Description 2',
                'price' => null,
                'stock' => null,
                'status' => false
            ]
        ]);
    }
}
