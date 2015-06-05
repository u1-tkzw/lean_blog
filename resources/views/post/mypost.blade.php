@extends('app')

@section('content')

<input type="hidden" id="userId" name="userId" value="{{ $user_id }}" />
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <!-- ヘッダ -->
                <div class="panel-heading">
                    {{ Auth::user()->name }} の投稿一覧
                </div>
                
                <!-- ボディ -->
                <div class="panel-body">
                    <div class="row">
                        <!-- プロフィール -->
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <p>ここにプロフィール表示</p>
                                    <br>
                                    <br>
                                    <br>
                                    <p>ダミー</p>
                                </div>
                            </div>
                        </div>
                        <!-- 投稿記事一覧 -->
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div id="posts_area"></div>
                                    <p class="text-center"><a href="#top">ページトップへ戻る</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <?= scripts('js/lib-mypost.js'); ?>
@endsection