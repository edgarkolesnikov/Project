<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities =['Vilnius', 'Kaunas', 'Klaipėda', 'Šiauliai', 'Panevėžys', 'Druskininkai', 'Marijampolė',
            'Utena', 'Nida', 'Kryžkalnis', 'Kita'];
        foreach($cities as $city){
            DB::table('cities')->insert([
                'name'=>$city
            ]);
        }
    }
}
