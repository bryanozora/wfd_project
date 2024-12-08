<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class transactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaction')->insert([
            [
                'user_id' => 1,
                'album_id' => 1,
                'jumlah' => 1,
                'harga' => 100000,
                'status' => 'unpaid'
            ],
            [
                'user_id' => 1,
                'album_id' => 1,
                'jumlah' => 2,
                'harga' => 200000,
                'status' => 'paid'
            ],
            [
                'user_id' => 1,
                'album_id' => 1,
                'jumlah' => 3,
                'harga' => 300000,
                'status' => 'delivered'
            ],
        ]);
    }
}
