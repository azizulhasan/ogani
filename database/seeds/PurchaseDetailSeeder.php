<?php

use Illuminate\Database\Seeder;
use App\Model\Product;
use App\Model\Purchase;
use App\Size;
use Illuminate\Support\Facades\DB;
class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_details')->insert([
            'purchase_id' =>  rand(1,1),
            'product_id' => rand(1,20),
            'quantity'=> rand(10,20),
            
            'parchase_rate'=> rand(500,1000)
        ]);
        DB::table('purchase_details')->insert([
            'purchase_id' =>  rand(2,2),
            'product_id' => rand(1,20),
            'quantity'=> rand(10,20),
            
            'parchase_rate'=> rand(500,1000)
        ]);
        DB::table('purchase_details')->insert([
            'purchase_id' =>  rand(3,3),
            'product_id' => rand(1,20),
            'quantity'=> rand(10,20),
            
            'parchase_rate'=> rand(500,1000)
        ]);

    }
}
