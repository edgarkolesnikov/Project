<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = ['Leather', 'Denim', 'Silk', 'Fabric', 'Cashmere', 'Cotton', 'Linen', 'Wool', 'Velvet', 'Other'];
        foreach ($materials as $material){
            DB::table('materials')->insert([
                'name'=>$material
            ]);
        }
    }
}
