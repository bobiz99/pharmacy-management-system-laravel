<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $departments = [
            'Neurology',
            'Cardiology',
            'Hematology',
            'Pediatrics',
            'Ophthalmology'
        ];

        foreach ($departments as $index=>$department) {
            $index+=1;
            DB::table('departments')->insert([
                'name' => $department,
                'description' => $faker->text,
                'image' => 'departments-'.$index.'.jpg'
            ]);
        }
    }
}
