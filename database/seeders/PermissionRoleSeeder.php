<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create permissions 
        Permission::create(['name' => 'add student', 'module' => 'student']);
        Permission::create(['name' => 'view student', 'module' => 'student']);
        Permission::create(['name' => 'update student', 'module' => 'student']);
        Permission::create(['name' => 'add student photo', 'module' => 'student']);
        Permission::create(['name' => 'delete student photo', 'module' => 'student']);
        Permission::create(['name' => 'add guardian to student', 'module' => 'student']);
        Permission::create(['name' => 'update guardian to student', 'module' => 'student']);
        Permission::create(['name' => 'delete guardian from student', 'module' => 'student']);
        
        Permission::create(['name' => 'add guardian', 'module' => 'guardian']);
        Permission::create(['name' => 'view guardian', 'module' => 'guardian']);
        Permission::create(['name' => 'update guardian', 'module' => 'guardian']);
        Permission::create(['name' => 'delete guardian', 'module' => 'guardian']);

        Permission::create(['name' => 'add educational history', 'module' => 'educational history']);
        Permission::create(['name' => 'update educational history', 'module' => 'educational history']);
        Permission::create(['name' => 'delete educational history', 'module' => 'educational history']);
        
        Permission::create(['name' => 'add user', 'module' => 'user']);
        Permission::create(['name' => 'view user', 'module' => 'user']);
        Permission::create(['name' => 'update user', 'module' => 'user']);
        Permission::create(['name' => 'delete user', 'module' => 'user']);

        Permission::create(['name' => 'add staff', 'module' => 'staff']);
        Permission::create(['name' => 'view staff', 'module' => 'staff']);
        Permission::create(['name' => 'update staff', 'module' => 'staff']);

        Permission::create(['name' => 'add chart of account', 'module' => 'accounting']);
        Permission::create(['name' => 'view chart of account', 'module' => 'accounting']);
        Permission::create(['name' => 'update chart of account', 'module' => 'accounting']);
        Permission::create(['name' => 'delete chart of account', 'module' => 'accounting']);
        Permission::create(['name' => 'add ledger account', 'module' => 'accounting']);
        Permission::create(['name' => 'view ledger account', 'module' => 'accounting']);
        Permission::create(['name' => 'update ledger account', 'module' => 'accounting']);
        Permission::create(['name' => 'delete ledger account', 'module' => 'accounting']);
        Permission::create(['name' => 'add journal transaction', 'module' => 'accounting']);
        Permission::create(['name' => 'view transaction', 'module' => 'accounting']);
        Permission::create(['name' => 'add expense', 'module' => 'accounting']);

        // create roles
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'accountant']);

        // assign role to default user
        $user = User::where('is_system', true)->first();
        $user->assignRole('admin');
    }
}