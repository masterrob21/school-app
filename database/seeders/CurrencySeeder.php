<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->insert([
            ['id' => 'ghs', 'currency' => 'ghana cedi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'usd', 'currency' => 'american dollar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}