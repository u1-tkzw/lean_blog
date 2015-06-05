<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('profiles')->truncate();

        Profile::create([
            'user_id'  => 1,
            'comment'  => 'はじめてのブログです。\nよろしくお願いします。',
            'sex'      => "male",
            'birthday' => '2000-01-01 12:00:00',
        ]);
    }

}
