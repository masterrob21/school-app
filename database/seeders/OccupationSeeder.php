<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('occupations')->insert([
            ['occupation' => 'Accountant'],
            ['occupation' => 'Account Officer'],
            ['occupation' => 'Nurse'],
            ['occupation' => 'Medical Doctor'],
            ['occupation' => 'Physician Assistant'],
            ['occupation' => 'Lab Technician'],
            ['occupation' => 'Teacher'],
            ['occupation' => 'Trainer'],
            ['occupation' => 'Civil Servant'],
            ['occupation' => 'Cashier'],
            ['occupation' => 'Sales Personnel'],
            ['occupation' => 'Broker'],
            ['occupation' => 'Banker'],
            ['occupation' => 'Trader'],
            ['occupation' => 'Business Man'],
            ['occupation' => 'Business Woman'],
        ]);
    }
}