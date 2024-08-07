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
            ['occupation' => 'Administrator'],
            ['occupation' => 'Auditor'],
            ['occupation' => 'Auto Electrician'],
            ['occupation' => 'Baker'],
            ['occupation' => 'Barber'],
            ['occupation' => 'Broadcaster'],
            ['occupation' => 'Carpenter'],
            ['occupation' => 'Contractor'],
            ['occupation' => 'Dancer'],
            ['occupation' => 'Data Analyst'],
            ['occupation' => 'Driver'],
            ['occupation' => 'Entrepreneur'],
            ['occupation' => 'Graphic Designer'],
            ['occupation' => 'Hair Dresser'],
            ['occupation' => 'Herbal Doctor'],
            ['occupation' => 'Immigration Officer'],
            ['occupation' => 'IT Technician'],
            ['occupation' => 'Judge'],
            ['occupation' => 'Lawyer'],
            ['occupation' => 'Lecturer'],
            ['occupation' => 'Manager'],
            ['occupation' => 'Mason'],
            ['occupation' => 'Mechanist'],
            ['occupation' => 'Pastor'],
            ['occupation' => 'Pharmacist'],
            ['occupation' => 'Pharmacy Assistant'],
            ['occupation' => 'Photographer'],
            ['occupation' => 'Plumber'],
            ['occupation' => 'Police Officer'],
            ['occupation' => 'Priest'],
            ['occupation' => 'Prison Officer'],
            ['occupation' => 'Researcher'],
            ['occupation' => 'Secretary'],
            ['occupation' => 'Security Officer'],
            ['occupation' => 'Soldier'],
            ['occupation' => 'Surgeon'],
            ['occupation' => 'Surveyor'],
            ['occupation' => 'Travel Agent'],
            ['occupation' => 'Unemployed'],
            ['occupation' => 'Web Developer'],
            ['occupation' => 'Welder'],
        ]);
    }
}