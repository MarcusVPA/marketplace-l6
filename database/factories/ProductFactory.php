<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'description' => $faker->sentence,              
        'body' => $faker->paragraph(5,true),// 5 paragrafos, true = retorna como string
        'price' => $faker->randomFloat(2,1,10), // 2 casas decimais,  min 1 e max 10
        'slug' => $faker->slug,
    ];
});
