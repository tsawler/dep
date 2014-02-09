@if((Session::has('message')) || (Session::has('error') || (count($errors) > 0)))
	<div class="container clearfix">
	<div class="row-fluid reverse-order"> 
	<div class="span12">
	@if(Session::has('message'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('message') }}
		</div>
	@endif
	@if (Session::has('error'))
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('error') }}
		</div>
	@endif
	@if (Session::has('status'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('status') }}
		</div>
	@endif
	@if(count($errors) > 0)
	<div class="alert alert-error">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	</div>
	</div>
	</div>
@endif