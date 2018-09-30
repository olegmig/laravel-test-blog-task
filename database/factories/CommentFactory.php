<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'author'  => sprintf('%s %s', $faker->firstName, $faker->lastName),
        'content' => $faker->sentence(10, 6),
        /*
        'category_id' => function () {
            return factory(\App\Category::class)->create()->id;
        },
        'post_id' => function () {
            return factory(\App\Post::class)->create()->id;
        },
        */
    ];
});
