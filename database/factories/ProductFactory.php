<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'=> $faker->word.' '.$faker->word,
        'description' => $faker->paragraph,
        'price'=>$faker->numberBetween($min=5, $max=10000),
        'imagePath'=> 'products/'.$faker->image('public/storage/products', 200, 150, null, false),
    ];
});
 