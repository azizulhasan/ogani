<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Model\Product;
use Faker\Generator as Faker;
use App\Model\Review;


$factory->define(Review::class, function (Faker $faker) {
    return [
        'product_id'      => function(){
            return Product::all()->random();
        },
        'customer_name'      => $faker->word,
        'review'    => $faker->paragraph,
        'star'     => $faker->numberBetween(0, 5),
        
    ];
});
