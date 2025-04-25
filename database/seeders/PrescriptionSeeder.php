<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $appointments = DB::table('appointments')->pluck('id')->toArray();

        foreach ($appointments as $appointmentId) {
            DB::table('prescriptions')->insert([
                'appointment_id' => $appointmentId,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
