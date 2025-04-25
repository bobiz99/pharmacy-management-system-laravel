<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            'Neurologist',
            'Cardiologist',
            'Hematologist',
            'Pediatrician',
            'Ophthalmologist'
        ];

        // Insert specializations into the database
        foreach ($specializations as $specialization) {
            DB::table('specializations')->insert([
                'name' => $specialization
            ]);
        }
    }
}
