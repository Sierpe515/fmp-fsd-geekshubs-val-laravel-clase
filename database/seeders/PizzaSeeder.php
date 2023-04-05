<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    // /**
    //  * Run the database seeds.
    //  *
    //  * @return void
    //  */
    // public function run()
    // {
    //     //
    // }
    public function run(): void
    {
        DB::table('pizzas')->insert([
            [
            'name' => "Carbonara",
            'type' => "original",
            ],
            [
            'name' => "Hawaiana",
            'type' => "fina",
            ],
            [
            'name' => "Barbacoa",
            'type' => "original",
            ],
        ]);
    }
}
