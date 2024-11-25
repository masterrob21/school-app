<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_types')->insert([
            ['program_type' => 'fees', 'created_at' => now(), 'updated_at' => now()],
            ['program_type' => 'bad debt', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}