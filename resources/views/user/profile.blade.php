@extends('app')

@section('content')

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
                            <img src="{{ asset('images/default/default_icon.png') }}" width="160" height="160" class="img-thumbnail" id="thumb">
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
<script type="text/javascript">
    $(function(){
        $('input[type=file]').change(function(){
            var file = $(this).prop('files')[0];
            if (! file.type.match('image/*')) {
                alert('画像ファイルを選択してください。');
                return;
            }
            var fileReader = new FileReader();
            fileReader.onload = function(){
                $('#thumb').attr('src', fileReader.result);
                console.log(file.type);
                console.log(file.name);
            };
            fileReader.readAsDataURL(file);
        });
    });

</script>
@endsection
