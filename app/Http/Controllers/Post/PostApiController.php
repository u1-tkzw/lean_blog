<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App;
use App\Post;
use App\Comment;
use Response;
use Input;
use Validator;
use DB;

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
        $count   = Input::get('count', 'all');
        $order   = Input::get('order', 'desc');
        $user_id = Input::get('user_id', 'all');

        $validator = \Validator::make(['order' => $order], [
            'order' => 'in:desc,asc'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        // パラメータチェック
//        if (!in_array($order, ['desc', 'asc'])) {
//            return App::abort(400);
//        }
        // TODO カスタムバリデータ
        if (!($count === 'all' || is_numeric($count))) {
            return App::abort(400);
        }
        if (!($user_id === 'all' || is_numeric($user_id))) {
            return App::abort(400);
        }

        $query = (new Post)->query();
        
        // SQL 文構築
        $sql_user_id = '';
        if ($user_id !== 'all') {
//            $sql_user_id = 'where user_id = ' . $user_id . ' ';
            $query->where('user_id', '=', $user_id);
            
        }
        $sql_limit = '';
        if ($count !== 'all') {
//            $sql_limit = ' LIMIT ' . $count . ' ';
            $query->limit($count);
        }
//        $sql = 'SELECT * FROM posts ' . $sql_user_id . 'ORDER BY date ' . $order . $sql_limit;

        // SQL 実行
//        $res = DB::select($sql);
        $res = $query->get();
        $res->each(function($post) {
            $post->body =  nl2br($post->body);
            return $post;
        });

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
        if (!is_numeric($id)) {
            return App::abort(400);
        }

        // 記事ID($parameter)を元に記事を抽出
        $post = Post::findorFail($id);
        if (is_null($post)) {
            return App::abort(400);
        }

        // 返却値生成
        $res             = [];
        $res['post']     = $post;
        $res['comments'] = $post->comments;

        return Response::json($res, 200, array(), JSON_PRETTY_PRINT);
    }

}
