<?php

namespace Database\Seeders;

use App\JsonPlaceholderApi\JsonPlaceholderApi;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $apiPosts = JsonPlaceholderApi::getResources('posts');

        foreach ($apiPosts as $post) {

            Post::create([
               'id' => $post['id'],
               'user_id' => $post['userId'],
               'title' => $post['title'],
               'body' => $post['body'],
            ]);

        }
    }
}
