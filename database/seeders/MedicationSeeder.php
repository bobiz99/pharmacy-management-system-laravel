<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1,30) as $index) {
            DB::table('medications')->insert([
                'name' => $faker->word,
                'type' => $faker->randomElement(['tablet', 'syrup', 'injection']),
                'description' => $faker->sentence,
            ]);
        }
    }
}
