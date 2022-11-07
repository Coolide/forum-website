<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_comment_1 = new Comment;
        $test_comment_1->text = "This is the first comment!";
        $test_comment_1->user_id = 1;
        $test_comment_1->post_id = 1;
        $test_comment_1->save();

        $test_comment_2 = new Comment;
        $test_comment_2->text = "This is the second comment!";
        $test_comment_2->user_id = 2;
        $test_comment_2->post_id = 1;
        $test_comment_2->save();

    }
}
