<?php

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('password_resets')->truncate();
    }

}
