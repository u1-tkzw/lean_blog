@extends('app')

@section('content')
<script type="text/javascript">
    // ベース URL 取得(暫定処置)
    var url_base = "<?= URL::to('/') ?>" + '/';

    // API 用の URL 生成
    var url = url_base + 'api/blog/post/' + <?php echo $post_id; ?>;
    //alert(url);

    // 記事データ取得
    $.getJSON(url, null, function(data){
        console.log(data);
    });
    //var res = [];
    //var res = getPostData(url);
    //console.log("view側");
    //console.log(res);
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <!-- ヘッダ表示部 -->
                <div class="panel-heading">	
                    <div class="row">
                        <div class="col-md-12">
                            <script type="text/javascript">
                                var res = [];
                                getPostData(url, res);
                                console.log(res);
                                document.write("<p>" +  res['post'].title + "</p>");
                                
                                
//                                $.ajax({
//                                    type: 'GET',
//                                    url: url,
//                                    cache: false,
//                                    datatype: 'json',
//                                    async: false,
//                                    success: function (data, textStatus, jqXHR) {
//                                        res = data;
//                                        console.log(data);
//                                    }
//                                });
//                                console.log(res);
                                
                                /*
                                 $.getJSON(url,null,funciton(data,status){
                                 console.log(data);
                                 });
                                 */
                                //document.write("<h3>" + res['post'].title + "</h3>");
                                // document.write("<small>" + res['post'].date + "</small>");
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <script type="text/javascript">
                                document.write("<small>" + res['post'].date + "</small>");
                            </script>
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
                    <script type="text/javascript">
                        document.write("<div>" + nl2br(res["post"].body) + "</div>");
                    </script>

                    <br>
                    <hr>

                    <!-- コメント表示部 -->
                    <strong>コメント</strong><br>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <script type="text/javascript">
                                for (var i in res['comments']) {
                                    document.write("<strong>" + res['comments'][i].name + "</strong><br>");
                                    document.write("<div>" + nl2br(res['comments'][i].body) + "</div><br>");
                                    document.write("<small>" + res['comments'][i].date + "</small>");
                                    document.write("<hr>");
                                }
                            </script>
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
