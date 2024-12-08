<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class genreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genre')->insert([
            [
                'name' => 'country'
            ],
            [
                'name' => 'pop'
            ],
            [
                'name' => 'dance'
            ],
            [
                'name' => 'electropop'
            ],
            [
                'name' => 'r&b'
            ],
            [
                'name' => 'hiphop'
            ],
            [
                'name' => 'reggae'
            ],
            [
                'name' => 'rock'
            ],
            [
                'name' => 'classic'
            ],
            [
                'name' => 'rap'
            ]
        ]);
    }
}