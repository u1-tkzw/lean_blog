<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('profiles')->truncate();

        Profile::create([
            'user_id'    => 1,
            'blog_title' => '☆テスト1のブログ☆',
            'comment'    => "はじめてのブログです。\nよろしくお願いします。",
            'sex'        => 'male',
            'birthday'   => '2000-01-01 12:00:00',
            'image'      => 'images/1/プロフ用.png',
        ]);
        Profile::create([
            'user_id'    => 2,
            'blog_title' => 'テスト2のブログ',
            'comment'    => "テスト用ブログ。",
            'sex'        => 'female',
            'birthday'   => '2015-01-01 12:00:00',
            'image'      => 'images/2/koala.jpg',
        ]);
    }

}
