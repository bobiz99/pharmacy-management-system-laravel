<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PrescribedMedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $prescriptionIds = DB::table('prescriptions')->pluck('id')->toArray();
        $medicationIds = DB::table('medications')->pluck('id')->toArray();

        foreach ($prescriptionIds as $prescriptionId) {
            // Each prescription might have more than one medication, adjust the range as needed
            foreach (range(1, $faker->numberBetween(1, 5)) as $index) {
                DB::table('prescribed_medications')->insert([
                    'prescription_id' => $prescriptionId,
                    'medication_id' => $faker->randomElement($medicationIds),
                    'quantity' => $faker->numberBetween(1, 15),
                    'instructions' => $faker->sentence
                ]);
            }
        }
    }
}
