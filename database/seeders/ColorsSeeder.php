<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['Black', 'Grey', 'Blue', 'Green', 'Violet', 'Purple', 'Pink', 'Almond', 'Sand', 'Red', 'Amber',
            'Gold', 'Silver', 'Bronze', 'Aqua', 'Brown', 'Coffee', 'Yellow', 'Orange', 'Coral', 'Olive', 'Other'];
        foreach($colors as $color){
            DB::table('colors')->insert([
                'name'=>$color
            ]);
        }
    }
}
