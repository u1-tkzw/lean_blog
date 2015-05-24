@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <div class="panel-heading">新規投稿</div>
                <div class="panel-body">
                    <form method="post" action="{{ url('/blog/post') }}">
                    
                        <!-- トークン -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="記事のタイトルを入力">
                        </div>
                        
                        <div class="form-group">
                            <label for="body">本文</label>
                            <textarea name="body" class="form-control" rows="15" value="{{ old('body') }}" placeholder="本文を入力"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="body">投稿日時(省略可能)</label>
                            <div class='input-group date' id="datetimepicker">
                                <input type='text' name="date" class="form-control" value="{{ old('date') }}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-default">投稿</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker();
    });
</script>
@endsection
