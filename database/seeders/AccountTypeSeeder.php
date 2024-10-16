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
            ['account_type' => 'Asset'],
            ['account_type' => 'Liability'],
            ['account_type' => 'Equity'],
            ['account_type' => 'Revenue'],
            ['account_type' => 'Expense'],
        ]);
    }
}