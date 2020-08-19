<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Apple',
            'category_id' => '1'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Papaya',
            'category_id' => '2'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Local Breakfast',
            'category_id' => '3'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Tea',
            'category_id' => '4'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Frozen Fish',
            'category_id' => '5'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Soup',
            'category_id' => '6'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Cheese',
            'category_id' => '7'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Frozen Snacks',
            'category_id' => '8'
        ]);
        DB::table('sub_categories')->insert([
            'sub_category_name'=> 'Cookies',
            'category_id' => '9'
        ]);
    }
}
