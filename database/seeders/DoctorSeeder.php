<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $doctorRoleId = DB::table('roles')->where('name', 'doctor')->first()->id;

        $doctors = DB::table('users')->where('role_id', $doctorRoleId)->pluck('id')->toArray();

        $departmentIds = DB::table('departments')->pluck('id')->toArray();
        $specializationIds = DB::table('specializations')->pluck('id')->toArray();

        foreach ($doctors as $index=>$userId) {
            $index += 1;
            DB::table('doctors')->insert([
                'user_id' => $userId,
                'specialization_id' => $faker->randomElement($specializationIds),
                'department_id' => $faker->randomElement($departmentIds),
                //'phone_number' => $faker->phoneNumber,
                //'image' => 'doctors-'.$index.'.jpg',
            ]);
        }
    }
}
