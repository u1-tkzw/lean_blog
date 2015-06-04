@extends('app')

@section('content')
<!-- コメント表示用テンプレート(jsRender) -->
<script id="comments_template" type="text/x-jsrender">
    <strong>{@:name@}</strong><br>
    <div>{@:body@}</div><br>
    <small>{@:date@}</small><br>
    <hr>
</script>

<!-- コメント表示用テンプレート(jsRender) -->
<script id="form_template" type="text/x-jsrender">
    <?= Form::open() ?>
        <input type="hidden" id="postId" name="postId" value="{@:post_id@}" />
        <input type="button" id="editBtn" value="編集" class="btn btn-primary btn-sm"  />
        <input type="button" id="deleteBtn" value="削除" class="btn btn-danger btn-sm"  />
    <?= Form::close() ?>
</script>


<script type="text/javascript">
    // 記事ID 取得
    var post_id = getPostID();
    // ベースURL取得
    var url_base = getBaseURL();
    // API 用の URL 生成
    var url = url_base + '/api/blog/post/' + post_id;

    // 記事データ取得・注入
    $(function(){
        var user_id = $('#userId').val();
        $.getJSON(url, null, function(data,status){
            // 記事注入(1件)
            $('#post_title').text(data['post'].title);
            $('#post_date').text(data['post'].date);
            $('#post_body').html(data['post'].body);
            // コメント注入(n件)
            $.views.settings.delimiters("{@","@}");
            var result = $("#comments_template").render(data['comments']);
            $("#comments_area").html(result);
            var button_html = $("#form_template").render({"post_id": post_id});
            if (data['post'].user_id == user_id){
                $('#control_button_area').html(button_html);
            }
        });
        $(document).on('click', '#deleteBtn', function() {
            deleteSubmit(post_id);
        });;
        $(document).on('click', '#editBtn', function() {
            editSubmit(post_id);
        });;
    });
</script>
<input type="hidden" id="userId" name="userId" value="{{ $user_id }}" />
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <!-- ヘッダ表示部 -->
                <div class="panel-heading">	
                    <div class="row">
                        <div class="col-md-12">
                            <!-- タイトル -->
                            <h2 id="post_title"></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <!-- 投稿日時 -->
                            <small id="post_date"></small>
                        </div>
                        <!-- ボタン表示部 -->
                        <div class="col-md-5 col-md-offset-2 text-right" id="control_button_area">
                        </div>
                    </div>
                </div>
                <a name="top"></a>

                <div class="panel-body">
                    <!-- 本文表示部 -->
                    <div id="post_body"></div><br>
                    <hr>
                    <!-- コメント表示部 -->
                    <strong>コメント</strong><br>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div id="comments_area"></div>
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

@section('scripts')
@stop