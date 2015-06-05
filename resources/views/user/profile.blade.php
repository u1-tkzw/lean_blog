@extends('app')

@section('content')
<script>
    var inputFile = document.getElementById('file');

    function fileChange(ev) {
        var target = ev.target;
        var files = target.files;

        console.log(files);
    }

    inputFile.addEventListener('change', fileChange, false);
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>プロフィール設定</h4></div>
                <div class="panel-body">

                    <form method="post" action="{{ url('/user/registry') }}">
                        <!-- トークン -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- ユーザID -->
                        <input type='hidden' name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                        <!-- プロフ画像 -->
                        <div class="media">
                            <img src="{{ url('images/profile/default_icon.png') }}" class="img-thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="image">プロフィール画像</label>
                            <input type="file" id="file"><br>
                        </div>
                        <!-- 名前 -->
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="">
                        </div>
                        <!-- プロフィール -->
                        <div class="form-group">
                            <label for="profile">プロフィール</label>
                            <textarea name="profile" class="form-control" rows="5" placeholder="プロフィールを入力">{!! nl2br(e(trans('...'))) !!}</textarea>
                        </div>
                        <!-- メールアドレス -->
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="">
                        </div>
                        <!-- パスワード -->
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="text" name="password" class="form-control" value="" placeholder="パスワードを変更する場合は入力してください">
                        </div>
                        <!-- パスワード確認用 -->
                        <div class="form-group">
                            <label for="password">パスワード(確認用)</label>
                            <input type="text" name="password" class="form-control" value="" placeholder="パスワードを変更する場合は入力してください">
                        </div>
                        <button type="submit" class="btn btn-default">登録</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
