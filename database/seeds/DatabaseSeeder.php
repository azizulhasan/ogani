<?php

use Illuminate\Database\Seeder;
use App\Model\Review;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Model\Product::class, 20)->create();
        // factory(App\Model\Review::class, 30)->create();
        // $this->call(UserSeeder::class);
        // $users = factory(App\User::class, 3)->create();
        // $review = factory(App\Model\Review::class, 300)->create();
        // $this->call($product, 50)->create();
        // $this->call($review, 300)->create();
        // factory(App\Model\Product::class, 50)->create();
        // factory(App\Model\Review::class, 300)-create();
    }
}
