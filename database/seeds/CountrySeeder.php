<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'country_name' => 'India',
        ]);
        DB::table('countries')->insert([
            'country_name' => 'Pakistan',
        ]);
        DB::table('countries')->insert([
            'country_name' => 'Maldhip',
        ]);
        DB::table('countries')->insert([
            'country_name' => 'Nepal',
        ]);
        DB::table('countries')->insert([
            'country_name' => 'Bhutan',
        ]);
        DB::table('countries')->insert([
            'country_name' => 'Bangladesh',
        ]);

    }
}
