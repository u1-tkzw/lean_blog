<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App;
use App\Post;
use App\Comment;
use Response;
use Input;
use Validator;

class PostApiController extends Controller
{

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        // オプションで auth 対象を指定
        //$this->middleware('auth', ['only' => ['']];
    }

    /**
     * 投稿記事一覧(Posts)取得用の API
     * クエリパラメータで取得件数を指定でき、指定件数分の投稿記事を返す。
     * 
     * @return JSON
     */
    public function getPosts()
    {
        // クエリパラメータ取得
        $count = Input::has('count') ? Input::get('count') : 'all';
        $order = Input::has('order') ? Input::get('order') : 'desc';
        
        // パラメータチェック
        if (!in_array($order, ['desc', 'asc'])){
            return App::abort(400);
        }
        if (!($count === 'all' || is_numeric($count))){
            return App::abort(400);
        }
        
        switch ($count) {
            case 'all' :
                if ($order === 'desc'){
                    $res = Post::latest('date')->get();
                } else {
                    $res = Post::oldest('date')->get();
                }
                break;
            default :
                if ($order === 'desc'){
                    $res = Post::latest('date')->take($count)->get();
                } else {
                    $res = Post::oldest('date')->take($count)->get();
                }
        }

        return Response::json($res, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * 記事取得用の API
     * 指定された ID の記事の内容と、紐付くコメント一覧を返す。
     * 
     * @param string $id URL のクエリとして記事のIDを受け取る
     * @return JSON
     */
    public function getPost($id)
    {
        // バリデーション
        if (!is_numeric($id)){
            return App::abort(400);
        }

        // 記事ID($parameter)を元に記事を抽出
        $post = Post::find($id);
        if (is_null($post)){
            return App::abort(400);
        }

        // 返却値生成
        $res             = [];
        $res['post']     = $post;
        $res['comments'] = $post->comments;

        return Response::json($res, 200, array(), JSON_PRETTY_PRINT);
    }

}
