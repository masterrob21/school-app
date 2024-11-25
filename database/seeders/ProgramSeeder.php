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
            ['program_type_id' => '1', 'program' => 'invoicing', 'sort_order' =>'10', 'created_at' => now(), 'updated_at' => now()],
            ['program_type_id' => '2', 'program' => 'bad debt', 'sort_order' =>'10', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}