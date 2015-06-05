<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name'     => 'test1',
            'email'    => 'test1@h2system.jp',
            'password' => Hash::make('h2system'),
        ]);
        User::create([
            'name'     => 'test2',
            'email'    => 'test2@h2system.jp',
            'password' => Hash::make('h2system'),
        ]);
    }

}
