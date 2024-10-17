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
            ['occupation' => 'Accountant', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Account Officer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Nurse', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Medical Doctor', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Physician Assistant', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Lab Technician', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Teacher', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Trainer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Civil Servant', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Sales Personnel', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Broker', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Banker', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Trader', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Business Man', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Business Woman', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Administrator', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Auditor', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Auto Electrician', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Baker', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Barber', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Broadcaster', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Carpenter', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Contractor', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Dancer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Data Analyst', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Driver', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Entrepreneur', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Graphic Designer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Hair Dresser', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Herbal Doctor', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Immigration Officer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'IT Technician', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Judge', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Lawyer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Lecturer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Mason', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Mechanist', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Pastor', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Pharmacist', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Pharmacy Assistant', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Photographer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Plumber', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Police Officer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Priest', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Prison Officer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Researcher', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Secretary', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Security Officer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Soldier', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Surgeon', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Surveyor', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Travel Agent', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Unemployed', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Web Developer', 'created_at' => now(), 'updated_at' => now()],
            ['occupation' => 'Welder', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}