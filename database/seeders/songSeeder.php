<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class songSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('song')->insert([
            [
                'album_id' => 1,
                'name' => 'Song 1',
                'duration' => '0:3:00',
                'lyrics' => 'Lyrics 1',
            ],
            [
                'album_id' => 1,
                'name' => 'Song 2',
                'duration' => '0:3:10',
                'lyrics' => 'Lyrics 2',
            ],
            [
                'album_id' => 2,
                'name' => 'Song 3',
                'duration' => '0:3:20',
                'lyrics' => 'Lyrics 3',
            ]
        ]);
    }
}
