<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'color_name' => 'Black'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'White'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Red'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Yellow'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Blue'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Green'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Pink'
        ]);
        DB::table('colors')->insert([
            'color_name' => 'Purple'
        ]);

    }
}
