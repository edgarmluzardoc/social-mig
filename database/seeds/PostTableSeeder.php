<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    const DEFAULT_SEEDS = 5;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= self::DEFAULT_SEEDS; $i++) {
            $post = new \App\Post([
                'title' => "Title for post #$i",
                'content' => "Content or description for post #$i"
            ]);
            $post->save();
        }
    }
}
