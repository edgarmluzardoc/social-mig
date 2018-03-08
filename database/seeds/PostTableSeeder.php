<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    const DEFAULT_POSTS_SEEDS = 5;
    const DEFAULT_POSTS_PRIVACY = 'public';
    const DEFAULT_COMMENTS_SEEDS = 2;
    const DEFAULT_LIKES_SEEDS = 1;
    const DEFAULT_USER_ID = 1;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating posts
        for ($postNumber = 1; $postNumber <= self::DEFAULT_POSTS_SEEDS; $postNumber++) {
            $post = new \App\Post([
                'title' => "Title for post #$postNumber",
                'content' => "Content or description for post #$postNumber",
                'privacy' => self::DEFAULT_POSTS_PRIVACY,
                'user_id' => self::DEFAULT_USER_ID
            ]);
            $post->save();

            // Creating comments
            for ($commentNumber = 1; $commentNumber <= self::DEFAULT_COMMENTS_SEEDS; $commentNumber++) {
                $comment = new \App\Comment([
                    'content' => "Comment #$commentNumber for post #$postNumber",
                    'user_id' => self::DEFAULT_USER_ID
                ]);
                $post->comments()->save($comment);
            }

            // Creating likes
            for ($likeNumber = 1; $likeNumber <= self::DEFAULT_LIKES_SEEDS; $likeNumber++) {
                $like = new \App\Like([
                    'user_id' => self::DEFAULT_USER_ID
                ]);
                $post->likes()->save($like);
            }
        }
    }
}
