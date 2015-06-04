<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler {

    /**
     * レポートしない例外タイプのリスト
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * 例外をレポート、もしくはログ
     *
     * ここはSentryやBugsnagなどに例外を送るために良い場所
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * HTTPレスポンスに設置する例外をレンダー
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // モデルが見つからない場合の例外
        if ($e instanceof ModelNotFoundException)
        {
            dd($e);
            /* TODO: API 側で使用する予定。レスポンスコードを返すようにしたい。*/
        }
        return parent::render($request, $e);
    }
}
