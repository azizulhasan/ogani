<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\Unit;

use App\User;
use App\Size;
use App\Color;
use App\Brand;

use Faker\Generator as Faker;


$factory->define(Product::class, function (Faker $faker) {

    
    $faker->addProvider(new EmanueleMinotto\Faker\PlaceholdItProvider($faker));
    return [
        'name'      => $faker->word,
        'detail'    => $faker->paragraph,
        'category_id'=> function(){
            return Category::all()->random();
        },
        'sub_category_id'=> function(){
            return SubCategory::all()->random();
        },
        'unit_id'=> function(){
            return Unit::all()->random();
        },
        'color_id'=> function(){
            return Color::all()->random();
        },
        'size_id'=> function(){
            return Size::all()->random();
        },
        'brand_id'=> function(){
            return Brand::all()->random();
        },
        'user_id'=> function(){
            return User::all()->random();
        },
        'picture1' => $faker->imageUrl('270x270', 'png', array('e6edf7' , 'fff' )),
        'picture2' => $faker->imageUrl('270x270', 'png', array('e6edf7' , 'fff' )),
        'picture3' => $faker->imageUrl('270x270', 'png', array('e6edf7' , 'fff' )),
        'picture4' => $faker->imageUrl('270x270', 'png', array('e6edf7' , 'fff' )),
        'default_picture' => $faker->imageUrl('270x270', 'png', array('e6edf7' , 'fff' ))
 
    ];
});
