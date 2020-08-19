<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('purchases')->insert([
            'date'=> date("Y-n-j"),
            'reference_no' => $this->generateRandomString('8')
        ]);
        DB::table('purchases')->insert([
            'date'=> date("Y-n-j"),
            'reference_no' => $this->generateRandomString('8')
        ]);
        DB::table('purchases')->insert([
            'date'=> date("Y-n-j"), 
            'reference_no' => $this->generateRandomString('8')
        ]);
    }

    protected function generateRandomString($length = 2) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
