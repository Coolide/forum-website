<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_post = new Post;
        $test_post->text = "This is a test post!";
        $test_post->up_votes = 31;
        $test_post->user_id = 1;
        $test_post->save();

        Post::factory()->count(5)->create();
    }
}
