<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App;
use App\Post;
use Response;
use Input;

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

    public function deletePost($id)
    {
        //$post = Post::findorFail($id);  // TODO: Exception 化
        $post = Post::find($id);
        if (is_null($post)) {
            return App::abort(400);
        }

        \DB::transaction(function() use ($post) {
            $post->comments()->delete();
            $post->delete();
        });

        $res = Response::make('delete success.', 200);
        return $res;
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
        $count        = Input::get('count', 'all');
        $order        = Input::get('order', 'desc');
        $user_id      = Input::get('user_id', 'all');
        $with_comments = Input::get('with_comments', 'false');

        // バリデーション
        $validator = \Validator::make(['order' => $order, 'with_comments' => $with_comments], [
            'order'        => 'in:desc,asc',
            'with_comments' => 'in:true,false'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

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
            $query->where('user_id', '=', $user_id);
        }
        $sql_limit = '';
        if ($count !== 'all') {
            $query->limit($count);
        }

        // SQL 実行
        $posts = $query->get();
        
        // 改行コード加工・コメント追加
        foreach ($posts as $post){
            $post->body = nl2br($post->body);

            if ($with_comments === 'true'){
                // $post に紐付くコメント抽出・追加
                $comments = $post->comments;
                foreach ($comments as $comment){
                    $comment->body = nl2br($comment->body);
                }
                $post['comments'] = $comments;
            }
        };

        return Response::json($posts, 200, array(), JSON_PRETTY_PRINT);
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
        //$post = Post::findorFail($id);  // TODO: Exception 化
        $post = Post::find($id);
        if (is_null($post)) {
            return App::abort(400);
        }

        // $post に紐付くコメント抽出
        $comments = $post->comments;

        // 返却値生成
        $post->body = nl2br($post->body);
        foreach ($comments as $comment) {
            $comment->body = nl2br($comment->body);
        }
        //dd($post,$comments);
        $res             = [];
        $res['post']     = $post;
        $res['comments'] = $comments;

        return Response::json($res, 200, array(), JSON_PRETTY_PRINT);
    }

}
