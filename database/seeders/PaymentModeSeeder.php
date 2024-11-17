<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_modes')->insert([
            ['payment_mode' => 'Cash', 'created_at' => now(), 'updated_at' => now()],
            ['payment_mode' => 'Adjust', 'created_at' => now(), 'updated_at' => now()],
            ['payment_mode' => 'Electronic', 'created_at' => now(), 'updated_at' => now()],
            ['payment_mode' => 'Transfer', 'created_at' => now(), 'updated_at' => now()],
            ['payment_mode' => 'Cheque', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}