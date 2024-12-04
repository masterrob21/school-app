<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'super-admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'teacher', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'student', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'parent', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'account-officer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}