<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rolls')->insert([
            'roll_name' => 'Admin'
        ]);
        DB::table('rolls')->insert([
            'roll_name' => 'Customer'
        ]);
        DB::table('rolls')->insert([
            'roll_name' => 'Subscriber'
        ]);
    }
}
