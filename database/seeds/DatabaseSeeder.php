<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;
use App\Comment;

class DatabaseSeeder extends Seeder
{

    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('PasswordResetsTableSeeder');
        $this->call('PostTableSeeder');
        $this->call('CommentTableSeeder');
    }

}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name'     => 'user01',
            'email'    => 'user01@example.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name'     => 'user02',
            'email'    => 'user02@example.com',
            'password' => Hash::make('password'),
        ]);
    }

}

class PasswordResetsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('password_resets')->truncate();
    }

}

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
    }

}

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
            'date'    => '2015-01-2 12:30:00',
        ]);
        Comment::create([
            'post_id' => 2,
            'name'    => 'テスト花子',
            'body'    => "これはサンプルコメント3です。\n改行テスト\n\n空白行を空けたテスト",
            'date'    => '2015-01-03 12:30:00',
        ]);
    }

}
