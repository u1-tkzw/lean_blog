<?php 

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use Response;
use Request;
use Redirect;
use Session;
use Input;
use Validator;

class BlogController extends Controller {

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
		// オプションで auth 対象を指定
		$this->middleware('auth', ['only' => ['getEntry']]);
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
	 * 記事投稿画面から渡された値を元に記事追加
	 * 
	 * @return view
	 */
    public function postPost(){
        
        $input = Input::only('user_id', 'title', 'body', 'date');

        // 投稿日時が空なら現在日時をセット
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
			return Redirect::back()->withInput($input)
				                   ->withErrors($validate->errors());
        }
        
		// 記事を DB に追加
		$post = Post::create([
			'user_id' => $input['user_id'],
			'title' => $input['title'],
			'body' => $input['body'],
			'date' => $input['date'],
		]);
		$post->save();
		
		Session::flash('info', "記事を投稿しました。");
        return view('blog.index');
    }
}