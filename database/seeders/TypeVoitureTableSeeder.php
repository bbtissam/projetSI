<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeVoitureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("type_voitures")->insert([
            
                ["nom"=>"audi"],
                ["nom"=>"bmw"],
                ["nom"=>"4x4"],
                ["nom"=>"toyota"],
             
            
        ]);
    }
}
