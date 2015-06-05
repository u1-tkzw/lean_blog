<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('images')->truncate();

        Image::create([
            'user_id'  => 1,
            'filename'  => 'プロフ用.png',
        ]);
        Image::create([
            'user_id'  => 1,
            'post_id'  => 1,
            'filename'  => 'ペンギン.jpg',
        ]);
    }
    
}