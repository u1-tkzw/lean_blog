@extends('app')

@section('content')

<!-- 記事表示用テンプレート(jsRender) -->
<script id="posts_template" type="text/x-jsrender">
    <div class="row">
        <div class="col-md-12">
            <h3>{(:date-)}</h3>
            <a href="{(getUrlBase/)}/post/view/{(:id)}"><h3>{(:title)}</h3></a>
            <div>{(:body)}</div>
            <br>
            {(if comments.length > 0)}
                <div style="background-color: #F5F5F5;"><strong>コメント</strong></div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        {(for comments)}
                            <strong>{(:name)}</strong><br>
                            <div>{(:body)}</div><br>
                            <small>{(:date)}</small><br>
                            <hr>
                        {(/for)}
                    </div>
                </div>
            {(/if)}
            <hr>
        </div>
    </div>
</script>

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