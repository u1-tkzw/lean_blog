<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('posts')->truncate();

        Post::create([
            'user_id' => 1,
            'title'   => 'サンプル記事01',
            'body'    => "これはサンプル記事1です。",
            'date'    => '2015-01-01 12:00:00',
        ]);
        Post::create([
            'user_id' => 1,
            'title'   => 'サンプル記事02',
            'body'    => "これはサンプル記事2です。\n改行テスト\n\n空白行を空けたテスト",
            'date'    => '2015-12-01 12:00:00',
        ]);
        Post::create([
            'user_id' => 2,
            'title'   => 'サンプル記事03',
            'body'    => "これはサンプル記事3です。",
            'date'    => '2015-12-01 12:00:00',
        ]);
        Post::create([
            'user_id' => 3,
            'title'   => '山田さんの記事04',
            'body'    => "これは山田さんが書いた記事だよ。",
            'date'    => '2015-05-01 12:00:00',
        ]);
        }

}