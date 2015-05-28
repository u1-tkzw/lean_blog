<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Input;
use Validator;

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
        $this->middleware('auth');
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
