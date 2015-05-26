<?php 

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App;
use App\Post;
use App\Comment;
use Response;
use Request;
use Redirect;
use Session;
use Input;
use Validator;

class BlogApiController extends Controller {

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
		// オプションで auth 対象を指定
		$this->middleware('auth', ['only' => ['postPost']]);
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
        $query = Request::query();
        
        // クエリが空白なら全件検索
        if (empty($query)){
            $query['count'] = 'all';
        }
        
        // ★ここでクエリのバリデーションが必要？
        
        switch ($query['count']){
            case 'all':
                $res = Post::all();
                break;
            default :
                $res = Post::all()->sortByDesc('date')->take($query['count']);
        }
        
        return Response::json($res);
    }

	/**
	 * 記事取得用の API
	 * 指定された ID の記事の内容と、紐付くコメント一覧を返す。
	 * 
	 * @param string $parameter URL のクエリとして記事のIDを受け取る
	 * @return JSON
	 */
    public function getPost($parameter)
    {
		// ★バリデーション
		
		// 記事ID($parameter)を元に記事を抽出
		$post = Post::where('id', $parameter)->first();
		
		// 記事IDに紐付くコメントを抽出
		$comments = Comment::where('post_id', $parameter)->get();
		
		// 返却値生成
		$res = [];
		$res['post'] = $post;
		$res['comments'] = $comments;
		
		return Response::json($res, 200, array(), JSON_PRETTY_PRINT);
    }
}