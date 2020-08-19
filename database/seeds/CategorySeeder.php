<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name' => 'Fruits'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Vegetables'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Breakfast'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Beverages'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Meat & Fish'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Snacks'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Dairy'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Frozen & Canned'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Bread & Bakery'
        ]);

    }
}
