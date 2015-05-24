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
     * アプリケーションのダッシュボードをユーザーへ表示
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('blog/index');
    }
    
    
    public function getEntry()
    {
        return view('blog/entry');
    }
    
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
    
    public function postPost(){
        
        $input = Input::only('title','body','date');
        
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
        
        if ($validate->fails()){
            dd($validate->errors());
            //return redirect()->back()->withErrors($validate->errors());
        }
        
        dd($input);
        
        return ;
    }
}
