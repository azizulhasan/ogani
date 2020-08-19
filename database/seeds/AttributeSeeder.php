<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->insert([
            'attribute_name' => 'color'
        ]);
        DB::table('attributes')->insert([
            'attribute_name' => 'size'
        ]);
        DB::table('attributes')->insert([
            'attribute_name' => 'brand'
        ]);
    }
}
