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
            ['account_type' => 'Asset', 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Liability', 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Equity', 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Revenue', 'created_at' => now(), 'updated_at' => now()],
            ['account_type' => 'Expense', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}