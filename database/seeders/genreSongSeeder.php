<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class genreSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genre_song')->insert([
            [
                'genre_id' => 1,
                'song_id' => 1
            ],
            [
                'genre_id' => 2,
                'song_id' => 1
            ],
            [
                'genre_id' => 3,
                'song_id' => 2
            ],
            [
                'genre_id' => 4,
                'song_id' => 2
            ],
            [
                'genre_id' => 5,
                'song_id' => 3
            ]
        ]);
    }
}
