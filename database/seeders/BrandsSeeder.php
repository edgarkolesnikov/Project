<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Adidas', 'Nike', 'Puma', 'Rebook', 'Fila', 'Hummel', 'Gucci', 'Prada', 'Chanel', 'Ralph Lauren',
            'Versace', 'Supreme', 'Zara', 'H&M', 'Dior', 'Burberry', 'Victoria Secret', 'Levis', 'Under Armor',
            'Skechers', 'Tommy Hilfiger', 'Michael Kors', 'Boss', 'Guess', 'Calvin Klein', 'No name', 'Other'];
        foreach($brands as $brand){
            DB::table('brands')->insert([
                'name'=>$brand
            ]);
        }
    }
}
