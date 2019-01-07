<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {

    return [
        'name'=> $faker->word,
        'description' => $faker->word.' '.$faker->word,     
        'iconPath'=> 'categories/'.$faker->image('public/storage/categories', 100, 75, null, false),
    ];
});
