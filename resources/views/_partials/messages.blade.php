@if ($errors->any())
<div class="alert alert-danger">
	<strong>Whoops!</strong><br><br>	
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

@if (session('flash.message') != null)
<div class="flash alert {{ Session::has('flash.class') ? session('flash.class') : 'alert-success' }}">
	{!! session('flash.message') !!}
</div>
@endif