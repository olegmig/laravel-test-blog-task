<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'name'    => ucfirst($faker->sentence(3)),
        'content' => $faker->paragraph(100),
//        'file'    => $faker->file(),
        /*
        'category_id' => function () {
            return factory(\App\Category::class)->create()->id;
        },
        */
    ];
});
