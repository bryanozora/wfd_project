<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class genreAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genre_album')->insert([
            [
                'genre_id' => 1,
                'album_id' => 1
            ],
            [
                'genre_id' => 2,
                'album_id' => 1
            ],
            [
                'genre_id' => 3,
                'album_id' => 2
            ]
        ]);
    }
}
