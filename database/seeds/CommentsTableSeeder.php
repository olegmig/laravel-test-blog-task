<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 100)->create()->each(function ($item) {
            // randomly save `category_id` or `post_id`
            if (mt_rand(0, 1)) {
                $item['category_id'] = optional(App\Category::all()->random())->id;
            } else {
                $item['post_id'] = optional(App\Post::all()->random())->id;
            }
            $item->save();
        });
    }
}
