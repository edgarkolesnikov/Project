<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClothesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clothes = ['Tops', 'Bottoms', 'Shoes', 'Outwear', 'Indoor', 'Sportswear', 'Activewear', 'Beachwear',
            'Shorts', 'Pants', 'Shirts', 'Dresses', 'Suits', 'Lingerie', 'Accessories'];
        foreach($clothes as $clothe){
            DB::table('clothes')->insert([
                'name'=>$clothe
            ]);
        }
    }
}
