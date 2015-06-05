<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\Profile;

class UserController extends Controller
{

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        // オプションで auth 対象を指定: 全画面
        //$this->middleware('auth');
    }

    /**
     * ユーザ一覧を表示
     *
     * @return view
     */
    public function userCheck($value)
    {
        $user = User::where('id', $value)->first();
        if (is_null($user)) {
            return view('errors.notFoundUser');
        }

        $profile = $user->profile;
        if (is_null($profile)) {
            $profile = getDummyUserObject($user);
        }

        return view('user/home', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * ユーザ設定画面を表示
     *
     * @return view
     */
    public function getProfile()
    {
        return view('user/profile');
    }

    /**
     * コンフィグ画面を表示
     *
     * @return view
     */
    public function getConfig()
    {
        return view('user/config');
    }

}
