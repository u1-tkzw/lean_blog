@extends('app')

@section('content')

<!-- 記事表示用テンプレート(jsRender) -->
<script id="posts_template" type="text/x-jsrender">
    {(if #index % 3 == 0)}
        </div><div class="row">
    {(/if)}
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div>ここに画像<br></div>
                <h3>{(:date-)}</h3>
                <a href="{(getUrlBase/)}/post/view/{(:id)}"><h3>{(:title)}</h3></a>
                <div>{(:body)}</div>
                <br>
                <div>アイコン</div>
                <div>投稿者名</div>
            </div>
        </div>
     </div>
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">みんなの投稿一覧</div>
                
                <div class="panel-body">
                    <div class="row">
                        <div id="posts_area"></div>
                    </div>
                    <p class="text-center"><a href=\"#top\">ページトップへ戻る</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <?= scripts('js/lib-index.js'); ?>
@endsection