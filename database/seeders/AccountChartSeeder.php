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
            ['account_head' => 'Property, Plant and Equipment', 'account_type_id' => '1', 'sort_order' => '10', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Cash and Cash Equivalent', 'account_type_id' => '1', 'sort_order' => '11', 'is_locked' => true, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Account Receivables', 'account_type_id' => '1', 'sort_order' => '12', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Account Payables', 'account_type_id' => '2', 'sort_order' => '20', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Ordinary Shareholders', 'account_type_id' => '3', 'sort_order' => '30', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Operating Income', 'account_type_id' => '4', 'sort_order' => '40', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Other Income', 'account_type_id' => '4', 'sort_order' => '41', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Administrative Expense', 'account_type_id' => '5', 'sort_order' => '50', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Personnel Expense', 'account_type_id' => '5', 'sort_order' => '51', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_head' => 'Training, Research and Development Expense', 'account_type_id' => '5', 'sort_order' => '52', 'is_locked' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}