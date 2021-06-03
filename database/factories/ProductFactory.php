<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use minify\Product;
use minify\Picture;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'product_description' => $faker->paragraph,
        'product_category' => function () {
            return factory(App\Category::class)->create()->id;
        }, 
        'amount' => $faker->randomFloat(2, 0, 10000),
        'image' => $faker->image('public/storage/images',640,480, null, false),

    ];
});

// $factory->define(Product::class, function (Faker $faker) {
//     return [
        
//     ];
// });

// $product = Product::factory()
//             ->has(Pictures::factory()->count(5))
//             ->create();
