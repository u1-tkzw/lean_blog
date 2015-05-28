<script type="text/javascript">
    // 改行コード処理用関数
    function nl2br(str) {
        return str.replace(/\r?\n/g, "<br />");
    }
    
    // 記事取得用 URI
    var url = "/api/blog/posts?user_id={{ Auth::user()->id }}";
    
    // 記事データ(JSON)格納用の配列
    var res = [];

    // 投稿済みの記事一覧を取得
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, false);  // 同期処理(false)
    xhr.onreadystatechange = function () {
        // request complete
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                res = JSON.parse(xhr.responseText);
            } else if (xhr.status === 204) {
                // No Content 時の処理
            } else {
                // Error 時の処理
            }
        }
    }
    xhr.send();
</script>

@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">{{ Auth::user()->name }} の投稿一覧</div>
                

                <div class="panel-body">
                    <script type="text/javascript">
                        for (var i in res) {
                            posturl = "post/view/" + res[i].id;
                            document.write("<h3>" + res[i].date + "</h3>");
                            document.write("<a href=\"" + posturl + "\">");
                            document.write("<h2>" + res[i].title + "</h2>");
                            document.write("</a>");
                            document.write("<div>" + nl2br(res[i].body) + "</div>");
                            document.write("<hr>");
                        }
                    </script>
                    <p class="text-center"><a href=\"#top\">ページトップへ戻る</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
