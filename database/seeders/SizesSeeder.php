<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46',
            'XS', 'S', 'M', 'L', 'XL', 'XXL', 'Other'];

        foreach($sizes as $size){

                DB::table('sizes')->insert([
                    'name'=>$size
                    ]);
            }
        }

}
