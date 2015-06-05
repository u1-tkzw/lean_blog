<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('comments')->truncate();

        Comment::create([
            'post_id' => 1,
            'name'    => 'テスト太郎',
            'body'    => "これはサンプルコメントです。",
            'date'    => '2015-01-01 12:10:00',
        ]);
        Comment::create([
            'post_id' => 1,
            'name'    => 'テスト次郎',
            'body'    => "これはサンプルコメント2です。",
            'date'    => '2015-01-02 12:30:00',
        ]);
        Comment::create([
            'post_id' => 2,
            'name'    => 'テスト花子',
            'body'    => "これはサンプルコメント3です。\n改行テスト\n\n空白行を空けたテスト",
            'date'    => '2015-01-03 12:30:00',
        ]);
    }

}
