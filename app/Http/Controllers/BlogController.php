<?php namespace App\Http\Controllers;

class BlogController extends Controller {

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * アプリケーションのダッシュボードをユーザーへ表示
     *
     * @return Response
     */
    public function index()
    {
        return view('blog');
    }

}
