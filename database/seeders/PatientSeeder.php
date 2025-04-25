<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Get the 'patient' role ID from the roles table
        $patientRoleId = DB::table('roles')->where('name', 'patient')->first()->id;

        // Get all users with the 'patient' role
        $patients = DB::table('users')->where('role_id', $patientRoleId)->pluck('id')->toArray();

        foreach ($patients as $userId) {

            $jmbg = '';
            for ($i = 0; $i < 13; $i++) {
                $jmbg .= mt_rand(0, 9); // Append a random digit (0-9) to the string
            }

            DB::table('patients')->insert([
                'user_id' => $userId,
                'address' => $faker->address,
                //'phone_number' => $faker->phoneNumber,
                'date_of_birth' => $faker->date,
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'JMBG' => $jmbg
            ]);
        }
    }
}
