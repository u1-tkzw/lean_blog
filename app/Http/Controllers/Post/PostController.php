<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use Response;
use Request;
use Redirect;
use Session;
use Input;
use Validator;

class PostController extends Controller
{

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        // オプションで auth 対象を指定
        $this->middleware('auth', ['only' => ['getCreate', 'getMypost', 'getEdit']]);
    }

    /**
     * 投稿記事一覧(index)画面を表示
     *
     * @return view
     */
    public function getIndex()
    {
        return view('post/index');
    }

    /** 記事の画面を表示
     * 
     * @return view
     */
    public function getView($post_id)
    {
        // ★バリデーション
        Post::findOrFail($post_id);
        return view('post/view', ['post_id' => $post_id]);
    }

    /** 投稿済み一覧画面を表示
     * 
     * @return view
     */
    public function getMypost()
    {
        return view('post/mypost');
    }

    /**
     * 記事投稿画面を表示
     * 
     * @return view
     */
    public function getCreate()
    {
        return view('post/create');
    }

    /**
     * 投稿記事の編集画面を表示
     * 
     * @return view
     */
    public function getEdit($id)
    {
        $post = Post::findOrFail($id);
        return view('post/edit',['post' => $post]);
    }

    /**
     * 記事投稿画面から渡された値を元に記事追加
     * 
     * @return view
     */
    public function postCreate()
    {
        $input = Input::only('user_id', 'title', 'body', 'date');

        // 投稿日時が空なら現在日時をセット
        if ($input['date'] === "") {
            $input['date'] = \Carbon\Carbon::now()->format('Y/m/d H:i:s');
        } else {
            // 入力値があれば秒(00)を付加
            $input['date'] .= ':00';
        }

        // バリデーション
        $validate = Validator::make($input, [
            'title' => 'required',
            'body'  => 'required',
            'date'  => 'date_format:Y/m/d H\\:i\\:s',
        ]);

        // バリデーションで問題ありならエラーを返す
        if ($validate->fails()) {
            return Redirect::back()->withInput($input)
            ->withErrors($validate->errors());
        }

        // 記事を DB に追加
        $post = Post::create([
            'user_id' => $input['user_id'],
            'title'   => $input['title'],
            'body'    => $input['body'],
            'date'    => $input['date'],
        ]);
        $post->save();

        Session::flash('info', "記事を投稿しました。");
        return Redirect::to('post/mypost');
    }
    
    /**
     * 編集した記事を保存
     * 
     * @return view
     */
    public function putEdit()
    {
        $input = Input::only('post_id', 'title', 'body', 'date');

        // 投稿日時が空なら現在日時をセット
        if ($input['date'] === "") {
            $input['date'] = \Carbon\Carbon::now();
        }
        
        // バリデーション
        $validate = Validator::make($input, [
            'title' => 'required',
            'body'  => 'required',
            'date'  => 'date_format:Y-m-d H\\:i\\:s',
        ]);

        // バリデーションで問題ありならエラーを返す
        if ($validate->fails()) {
            return Redirect::back()->withInput($input)
            ->withErrors($validate->errors());
        }
        
        // 元の記事を取得
        $post = Post::findOrFail($input['post_id']);
        
        // 記事を更新
        $post->title = $input['title'];
        $post->body = $input['body'];
        $post->date = $input['date'];
        $post->save();

        Session::flash('info', "記事を更新しました。");
        return Redirect::to('post/index');
    }
    
    /**
     * 記事画面から渡された値を元にコメント追加
     * 
     * @return view
     */
    public function postComment()
    {
        // 入力値取得
        $input = Input::only('post_id', 'name', 'body');

        // バリデーション
        $validate = Validator::make($input, [
            'name' => 'required',
            'body' => 'required',
        ]);

        // バリデーションで問題ありならエラーを返す
        if ($validate->fails()) {
            return Redirect::back()->withInput($input)
            ->withErrors($validate->errors());
        }

        // 投稿日時をセット
        $input['date'] = \Carbon\Carbon::now();

        // 記事を DB に追加
        $post = Comment::create([
            'post_id' => $input['post_id'],
            'name'    => $input['name'],
            'body'    => $input['body'],
            'date'    => $input['date'],
        ]);
        $post->save();

        Session::flash('info', "コメントしました。");
        return Redirect::back();
    }

}
