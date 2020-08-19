<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'brand_name' => 'Apple'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Samsung'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Symphony'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Lenevo'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Asus'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'HP'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Dell'
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Nokia'
        ]);

    }
}
