<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientesSeeder extends Seeder
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
        DB::table('ingredientes')->insert([
            [
            'quantity' => 400,
            'name' => "Queso Azul",
            'type' => "queso",
            ],
            [
            'quantity' => 300,
            'name' => "Peperoni",
            'type' => "fiambre",
            ],
            [
            'quantity' => 1000,
            'name' => "Oregano",
            'type' => "especia",    
            ],
        ]);
    }
}
