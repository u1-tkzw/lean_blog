<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class DatabaseSeeder extends Seeder {

    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('PostTableSeeder');
        $this->call('PasswordResetsTableSeeder');
    }

}

class UserTableSeeder extends Seeder {
    
    public function run() {
        DB::table('users')->truncate();
        
        User::create([
            'name' => 'user01',
            'email' => 'user01@example.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'user02',
            'email' => 'user02@example.com',
            'password' => Hash::make('password'),
        ]);
    }
    
}

class PasswordResetsTableSeeder extends Seeder {
    
    public function run() {
        DB::table('password_resets')->truncate();
    }
}

class PostTableSeeder extends Seeder {
    
    public function run() {
        DB::table('posts')->truncate();
        
        Post::create([
            'user_id' => 1,
            'title' => 'サンプル記事01',
            'body' => 'これはサンプル記事です。',
            'date' => '2015-01-01 12:00:00',
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'サンプル記事02',
            'body' => 'これはサンプル記事です。',
            'date' => '2015-12-01 12:00:00',
        ]);
    }
}
