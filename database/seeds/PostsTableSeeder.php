<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 50)->create()->each(function ($item) {
            $item['category_id'] = optional(App\Category::all()->random())->id;
            $item->save();
        });
    }
}
