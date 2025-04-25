<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class  RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles
        $roles = ['admin', 'doctor', 'patient'];

        // Insert roles into the database
        for ($i = 0; $i < count($roles); $i++) {
            DB::table('roles')->insert([
                'name' => $roles[$i]
            ]);
        }
    }
}
