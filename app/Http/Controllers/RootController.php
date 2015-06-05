<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Response;

class RootController extends Controller {

    /**
     * 新しいコントローラーインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * ログイン済みならば自身のホーム、未ログインなら記事一覧を表示
     *
     * @return Response
     */
    public function index($value)
    {
        if ($value === 'post'){
            return Redirect::to('post');
        }
        dd($value);
        return Redirect::to('post');
    }

}
