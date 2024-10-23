<?php

namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Relation::insert([
            ['relation' => 'Father', 'created_at' => now(), 'updated_at' => now()],
            ['relation' => 'Mother', 'created_at' => now(), 'updated_at' => now()],
            ['relation' => 'Guardian', 'created_at' => now(), 'updated_at' => now()],
            ['relation' => 'Uncle', 'created_at' => now(), 'updated_at' => now()],
            ['relation' => 'Aunty', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}