<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Assuming you're differentiating patients by a role
        //$patientRoleId = DB::table('roles')->where('name', 'patient')->first()->id;
        $patientIds = DB::table('patients')->pluck('id')->toArray();

        //$doctorRoleId = DB::table('roles')->where('name', 'doctor')->first()->id;
        $doctorIds = DB::table('doctors')->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++)  {
            DB::table('appointments')->insert([
                'patient_id' => $faker->randomElement($patientIds),
                'doctor_id' => $faker->randomElement($doctorIds),
                'appointment_time' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
                'status' => $faker->randomElement(['scheduled', 'cancelled', 'completed']),
                'notes' => $faker->sentence,
            ]);
        }
    }
}
