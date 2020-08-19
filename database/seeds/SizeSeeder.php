<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            'size_name' => 'XL'
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'M'
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'L'
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'SM'
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'XM'
        ]);

    }
}
