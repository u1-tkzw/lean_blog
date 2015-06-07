<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

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
    public function getIndex()
    {
        // ログインしていなければ投稿一覧へ
        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            return redirect('/post');
        }

        return \Redirect::to("user/home/$user_id");
    }
    
    /**
     * ユーザの記事一覧を表示
     *
     * @return view
     */
    public function getHome($user_id)
    {
        $user = User::where('id', $user_id)->first();
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
    public function getProfile($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if (is_null($user)) {
            return view('errors.notFoundUser');
        }

        $profile = $user->profile;
        if (is_null($profile)) {
            $profile = getDummyUserObject($user);
        }
        
        return view('user/profile', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * コンフィグ画面を表示
     *
     * @return view
     */
    public function getConfig()
    {
        dd("config");
        return view('user/config');
    }

}
