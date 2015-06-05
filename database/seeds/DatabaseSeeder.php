<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        $this->call('ProfileTableSeeder');
        $this->call('ImageTableSeeder');
    }

}
