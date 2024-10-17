<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('account_charts')->insert([
            ['account_head' => 'Property, Plant and Equipment', 'account_type_id' => '1', 'sort_order' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Cash and Cash Equivalent', 'account_type_id' => '1', 'sort_order' => '20', 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Receivables', 'account_type_id' => '1', 'sort_order' => '30', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}