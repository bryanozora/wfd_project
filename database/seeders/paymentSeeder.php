<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class paymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment')->insert([
            [
                'transaction_id' => 2,
                'receipt' => 'Receipt 1'
            ],
            [
                'transaction_id' => 3,
                'receipt' => 'Receipt 2'
            ]
        ]);
    }
}
