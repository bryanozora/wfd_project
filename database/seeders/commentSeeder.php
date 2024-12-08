<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comment')->insert([
            [
                'album_id' => 1,
                'user_id' => 1,
                'comment' => 'Comment 1'
            ],
            [
                'album_id' => 1,
                'user_id' => 1,
                'comment' => 'Comment 2'
            ]
        ]);
    }
}
