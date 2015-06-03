@extends('app')

@section('content')
<script type="text/javascript">
    $(function(){
      $('#datetimepicker').datetimepicker({lang: 'ja', step: 10});
    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">新規投稿</div>
                <div class="panel-body">
                    <?= Form::open(['url' => 'post/create']) ?>
                    
                        <!-- ユーザID -->
                        <input type='hidden' name="user_id" class="form-control" value="{{ Auth::user()->id }}">

                        <!-- タイトル -->
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="記事のタイトルを入力">
                        </div>

                        <!-- 本文 -->
                        <div class="form-group">
                            <label for="body">本文</label>
                            <textarea name="body" class="form-control" rows="15" placeholder="本文を入力">{{ old('body') }}</textarea>
                        </div>

                        <!-- 投稿日時 -->
                        <div class="form-group">
                            <label for="body">投稿日時(省略可能)</label>
                            <div class='input-group'>
                                <input type="text" name="date" class="form-control" value="{{ old('date') }}" id="datetimepicker"  placeholder="例) 2015/01/01 12:30">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default">投稿</button>
                    <?= Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
