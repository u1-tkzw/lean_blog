<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/jsrender/1.0pre35/jsrender.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/lib-common.js') }}" type="text/javascript"></script>

    <!-- DatatimePicker -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.datetimepicker.css') }}"/ >
    <script src="{{ asset('js/jquery.datetimepicker.js') }}" type="text/javascript"></script>

</head>
<body>
    <!-- トップへ戻る用 -->
    <a name="top"></a>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/user') }}">ホーム</a></li>
                    <li><a href="{{ url('/post') }}">投稿一覧</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">ログイン</a></li>
                        <li><a href="{{ url('/auth/register') }}">ユーザ登録</a></li>
                    @else
                        <!-- <li><a href="{{ url('/post/mypost') }}">投稿済み一覧</a></li> -->
                        <li><a href="{{ url('/post/create') }}">記事を書く</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> {{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/post/create') }}"><span class="glyphicon glyphicon-pencil"></span> 記事を書く</a></li>
                                <!-- <li><a href="{{ url('/post/mypost') }}"><span class="glyphicon glyphicon-file"></span> 投稿済み一覧</a></li> -->
                                <li><a href="{{ url('/user/config') }}"><span class="glyphicon glyphicon-cog"></span> ブログ設定</a></li>
                                <li><a href="{{ url('/user/profile/' . Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span> ユーザ設定</a></li>
                                <li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-off"></span> ログアウト</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
	
	<!-- 情報表示 -->
	@include('infobar')

	<!-- コンテンツ表示 -->
    @yield('content')
    
    <!-- スクリプト読込 -->
    @yield('script')

</body>
</html>
