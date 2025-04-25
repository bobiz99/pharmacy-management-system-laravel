<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // First, let's make sure we have some roles to assign to users
//        $adminRole = DB::table('roles')->insertGetId(['name' => 'admin']);
//        $doctorRole = DB::table('roles')->insertGetId(['name' => 'doctor']);
//        $patientRole = DB::table('roles')->insertGetId(['name' => 'patient']);

        // Now, create the users with a random role from the ones we've just created
        for ($i = 1; $i < 11; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                //'email_verified_at' => now(),
                'password' => Hash::make('test123'),
                'role_id' => rand(1,3),
                'phone_number' => $faker->phoneNumber,
                'image' => 'doctors-'.$i.'.jpg',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
