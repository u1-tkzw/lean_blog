@if (Session('info'))
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="alert alert-info">
				<strong>インフォメーション</strong><br>
				@if (is_array(Session::get('info')))
					<ul>
						@foreach (Session::get('info') as $message)
							<li>{{ $message }}</li>
						@endforeach
					</ul>
				@else
					<li>{{ Session::get('info') }}</li>
				@endif
			</div>
		</div>
	</div>
</div>
@endif

@if (count($errors) > 0)
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="alert alert-danger">
				<strong>エラー</strong><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endif

@if (session('status'))
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		</div>
	</div>
</div>
@endif
