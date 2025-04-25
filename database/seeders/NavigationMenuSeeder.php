<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private array $names = ['Home', 'Departments', 'Doctors', 'Contact'];
    private array $routes = ['home', 'departments', 'doctors', 'contact'];

    public function run(): void
    {
        for($i = 0; $i < count($this->names); $i++) {
            DB::table('navigation_menus')->insert([
                'name' => $this->names[$i],
                'route' => $this->routes[$i],
                'order' => $i
            ]);
        }
    }
}
