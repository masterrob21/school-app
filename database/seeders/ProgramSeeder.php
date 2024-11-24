<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            ['program_type_id' => '1', 'progam' => 'invoicing', 'created_at' => now(), 'updated_at' => now()],
            ['program_type_id' => '2', 'progam' => 'bad debt', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}