<?php 

namespace App\Http\Controllers;

use Response;
use Request;
use Input;
use Validator;
use App\Post;

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
     * 投稿記事一覧(index)画面を表示
     *
     * @return view
     */
    public function getIndex()
    {
        return view('blog/index');
    }
    
    /**
	 * 記事投稿画面を表示
	 * 
	 * @return view
	 */
    public function getEntry()
    {
        return view('blog/entry');
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
                $res = Post::all()->take($query['count']);
        }
        
        return Response::json($res);
    }
    
	/**
	 * 記事投稿用の API
	 * @return 
	 */
    public function postPost(){
        
        $input = Input::only('user_id', 'title', 'body', 'date');

        // 投稿日時が　null なら現在日時をセット
        if ($input['date'] === ""){
            $input['date'] = date('Y-m-d H:i:s');
        }
        
        // バリデーション
        $validate = Validator::make($input, [
            'title' => 'required',
            'body' => 'required',
            'date' => 'date_format:Y-m-d H\\:i\\:s',
        ]);
		
        // バリデーションで問題ありならエラーを返す
        if ($validate->fails()){
            dd($validate->errors());
            //return redirect()->back()->withErrors($validate->errors());
        }
        
		// 記事を DB に追加
		$post = Post::create([
			'user_id' => $input['user_id'],
			'title' => $input['title'],
			'body' => $input['body'],
			'date' => $input['date'],
		]);
		$post->save();

        return ;
    }
}
