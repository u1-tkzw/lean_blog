<script type="text/javascript">
    
    // 記事データ(JSON)格納用の配列
    var res = [];
    
	// API 用の URL 生成
	var url = "/api/blog/post/" + <?php echo $post_id; ?>;
	
    // 記事を取得
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, false);  // 同期処理(false)
    xhr.onreadystatechange = function(){
        // request complete
        if (xhr.readyState === 4){
            if (xhr.status === 200){
                res = JSON.parse(xhr.responseText);
            } else if (xhr.status === 204){
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
				<!-- ヘッダ表示部 -->
                <div class="panel-heading">	
					<script type="text/javascript">
						document.write("<h3>" + res["post"].title + "</h3>");
						document.write("<small>" + res["post"].date + "</small>");
					</script>
				</div>
                <a name="top"></a>
				
                <div class="panel-body">
					<!-- 本文表示部 -->
                    <script type="text/javascript">
						document.write("<div>" + res["post"].body + "</div>");
                    </script>
					
					<br>
					<hr>
					
					<!-- コメント表示部 -->
					<strong>コメント</strong><br>
					
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<script type="text/javascript">
								for (var i in res["comments"]){
									document.write("<strong>" + res["comments"][i].name + "</strong><br>");
									document.write("<div>" + res["comments"][i].body + "</div><br>");
									document.write("<small>" + res["comments"][i].date + "</small><br>");
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
						<form method="post" action="{{ url('/blog/comment') }}">
							<hr>
							<!-- トークン -->
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<!-- コメント文 -->
							<div class="form-group">
								<label for="body">コメント</label>
								<textarea name="body" class="form-control" rows="3" value="{{ old('body') }}" placeholder="コメントを入力"></textarea>
							</div>
							<!-- 名前 -->
							<div class="form-group">
								<label for="title">名前</label>
								<input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="名前を入力">
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
