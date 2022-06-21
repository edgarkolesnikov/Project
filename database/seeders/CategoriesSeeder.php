<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Winter', 'Summer', 'Autumn', 'Spring', 'Sportswear', 'Suits', 'Indoor', 'Outdoor'];
        foreach($categories as $category){
            DB::table('categories')->insert([
                'name' => $category
            ]);
        }
    }
}
