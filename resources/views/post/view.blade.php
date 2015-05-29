@extends('app')

@section('content')
<script type="text/javascript">
    // ベース URL 取得(暫定処置)
    var url_base = "<?= URL::to('/') ?>" + '/';

    // API 用の URL 生成
    var url = url_base + 'api/blog/post/' + <?php echo $post_id; ?>;

    // 記事データ取得・注入
    $(function(){
        $.getJSON(url, null, function(data,status){
            // 記事注入(1件)
            $('#post_title').text(data['post'].title);
            $('#post_date').text(data['post'].date);
            $('#post_body').text(nl2br(data['post'].body));
            console.log(data['post'].body);
            console.log(nl2br(data['post'].body));
            // コメント注入(n件)
            for (var i in data['comments']) {
                $('#comment_name').text(data['comments'][i].name);
                $('#comment_body').text(nl2br(data['comments'][i].body));
                $('#comment_date').text(data['comments'][i].date);
            }
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <!-- ヘッダ表示部 -->
                <div class="panel-heading">	
                    <div class="row">
                        <div class="col-md-12">
                            <h2 id="post_title">Title</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <small id="post_date">Date</small>
                        </div>
                        <div class="col-md-5 col-md-offset-2 text-right">
                            @if (!Auth::guest())
                                <?= Form::open() ?>
                                    <input type="button" value="編集" class="btn btn-primary btn-sm" onclick="editSubmit(url_base + 'post/edit/' + res['post'].id)">
                                    <input type="button" value="削除" class="btn btn-danger btn-sm" onclick="deletSubmit();">
                                <?= Form::close() ?>
                            @endif
                        </div>
                    </div>
                </div>
                <a name="top"></a>

                <div class="panel-body">
                    <!-- 本文表示部 -->
                    <div id="post_body">Body</div><br>
                    <hr>
                    <!-- コメント表示部 -->
                    <strong>コメント</strong><br>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <strong id="comment_name">Name</strong><br>
                            <div id="comment_body">Body</div><br>
                            <small id="comment_date">Date</small><br>
                            <hr>
                        </div>
                    </div>
                    <!-- コメントボタン -->
                    <div class="text-center">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#comment_form">
                            <span class="glyphicon glyphicon-pencil"></span>
                            コメントする
                        </button>
                    </div>

                    <div id="comment_form" class="collapse">
                        <!-- コメント投稿フォーム -->
                        <form method="post" action="{{ url('/post/comment') }}">
                            <hr>
                            <!-- トークン -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- ポストID -->
                            <input type='hidden' name="post_id" class="form-control" value="{{ $post_id }}">
                            <!-- コメント文 -->
                            <div class="form-group">
                                <label for="body">コメント</label>
                                <textarea name="body" class="form-control" rows="3" placeholder="コメントを入力">{{ old('body') }}</textarea>
                            </div>
                            <!-- 名前 -->
                            <div class="form-group">
                                <label for="title">名前</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="名前を入力">
                            </div>
                            <button type="submit" class="btn btn-default">投稿</button>
                        </form>
                    </div>

                    <!-- panel_body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
