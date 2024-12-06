<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'add student', 'guard_name' => 'web', 'module' =>'student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view student', 'guard_name' => 'web', 'module' =>'student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update student', 'guard_name' => 'web', 'module' =>'student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'add student photo', 'guard_name' => 'web', 'module' =>'student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete student photo', 'guard_name' => 'web', 'module' =>'student', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add guardian to student', 'guard_name' => 'web', 'module' => 'guardian-to-student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update guardian to student', 'guard_name' => 'web', 'module' => 'guardian-to-student', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete guardian from student', 'guard_name' => 'web', 'module' => 'guardian-to-student', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add guardian', 'guard_name' => 'web', 'module' => 'guardian/parent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view guardian', 'guard_name' => 'web', 'module' => 'guardian/parent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update guardian', 'guard_name' => 'web', 'module' => 'guardian/parent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete guardian', 'guard_name' => 'web', 'module' => 'guardian/parent', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add education history', 'guard_name' => 'web', 'module' => 'educational-history', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update education history', 'guard_name' => 'web', 'module' => 'educational-history', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete education history', 'guard_name' => 'web', 'module' => 'educational-history', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add user', 'guard_name' => 'web', 'module' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view user', 'guard_name' => 'web', 'module' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update user', 'guard_name' => 'web', 'module' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete user', 'guard_name' => 'web', 'module' => 'user', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add staff', 'guard_name' => 'web', 'module' => 'staff', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view staff', 'guard_name' => 'web', 'module' => 'staff', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update staff', 'guard_name' => 'web', 'module' => 'staff', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add chart of account', 'guard_name' => 'web', 'module' => 'chart-of-account', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view chart of account', 'guard_name' => 'web', 'module' => 'chart-of-account', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update chart of account', 'guard_name' => 'web', 'module' => 'chart-of-account', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete chart of account', 'guard_name' => 'web', 'module' => 'chart-of-account', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add ledger account', 'guard_name' => 'web', 'module' => 'ledger-account', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update ledger account', 'guard_name' => 'web', 'module' => 'ledger-account', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete ledger account', 'guard_name' => 'web', 'module' => 'ledger-account', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add journal transaction', 'guard_name' => 'web', 'module' => 'journal-transaction', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add course', 'guard_name' => 'web', 'module' => 'course', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view course', 'guard_name' => 'web', 'module' => 'course', 'module' => 'course', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update course', 'guard_name' => 'web', 'module' => 'course', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete course', 'guard_name' => 'web', 'module' => 'course', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add department', 'guard_name' => 'web', 'module' => 'department', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view department', 'guard_name' => 'web', 'module' => 'department', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update department', 'guard_name' => 'web', 'module' => 'department', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete department', 'guard_name' => 'web', 'module' => 'department', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add occupation', 'guard_name' => 'web', 'module' => 'occupation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view occupation', 'guard_name' => 'web', 'module' => 'occupation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update occupation', 'guard_name' => 'web', 'module' => 'occupation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete occupation', 'guard_name' => 'web', 'module' => 'occupation', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add relation', 'guard_name' => 'web', 'module' => 'relation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view relation', 'guard_name' => 'web', 'module' => 'relation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update relation', 'guard_name' => 'web', 'module' => 'relation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete relation', 'guard_name' => 'web', 'module' => 'relation', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add classroom', 'guard_name' => 'web', 'module' => 'classroom', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view classroom', 'guard_name' => 'web', 'module' => 'classroom', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update classroom', 'guard_name' => 'web', 'module' => 'classroom', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete classroom', 'guard_name' => 'web', 'module' => 'classroom', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add currency', 'guard_name' => 'web', 'module' => 'currency', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view currency', 'guard_name' => 'web', 'module' => 'currency', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update currency', 'guard_name' => 'web', 'module' => 'currency', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete currency', 'guard_name' => 'web', 'module' => 'currency', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'view payment method', 'guard_name' => 'web', 'module' => 'payment-method', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update payment method', 'guard_name' => 'web', 'module' => 'payment-method', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'view branch', 'guard_name' => 'web', 'module' => 'branch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update branch', 'guard_name' => 'web', 'module' => 'branch', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'view program type', 'guard_name' => 'web', 'module' => 'program-type', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update program type', 'guard_name' => 'web', 'module' => 'program-type', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'add program', 'guard_name' => 'web', 'module' => 'program', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'view program', 'guard_name' => 'web', 'module' => 'program', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'update program', 'guard_name' => 'web', 'module' => 'program', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete program', 'guard_name' => 'web', 'module' => 'program', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}