<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('account_types')->insert([
            ['account_type' => 'Asset', 'is_credit' => false, 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Liability', 'is_credit' => true, 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Equity', 'is_credit' => true, 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Revenue', 'is_credit' => true, 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Expense', 'is_credit' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}