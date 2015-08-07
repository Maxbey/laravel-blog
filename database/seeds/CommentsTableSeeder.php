<?php

use App\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        Comment::create([
            'user_id' => 1,
            'article_id' => 1,
            'author' => 'admin',
            'body' => 'Admin`s comment'
        ]);

        Comment::create([
            'article_id' => 1,
            'author' => 'Anonymous',
            'body' => 'Test comment'
        ]);
    }
}
