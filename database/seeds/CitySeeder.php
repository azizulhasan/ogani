<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'city_name' => 'Dhaka',
            'country_id' => 6
        ]);
        DB::table('cities')->insert([
            'city_name' => 'Delhi',
            'country_id' => 1
        ]);
        DB::table('cities')->insert([
            'city_name' => 'Islamabad',
            'country_id' => 2
        ]);
        DB::table('cities')->insert([
            'city_name' => 'Male',
            'country_id' => 3
        ]);
        DB::table('cities')->insert([
            'city_name' => 'Kathmundo',
            'country_id' => 4
        ]);
        DB::table('cities')->insert([
            'city_name' => 'Thimpu',
            'country_id' => 5
        ]);

    }
}
