@extends('layout')

@section('browser-title')
Log in to your account: The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="Log in to your account at the Dog-eared Press, an independent publisher of Fantasy and Science Fiction eBooks.." />
@stop


@section('content')

	<div class="container">
		<h3 class="short_headline" style="text-transform: none;"><span>Login</span></h3>
		<p>You'll need an account to buy books, or to submit a manuscript for consideration. If you have one, just log in below.
		<br>
		Don't have an account? <strong><a href="/users/register">Create an account</a></strong>, and rest assured that your personal information is safe with us.
		</p>

	{{ Form::open(array('url' => 'users/signin', 'class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}

		<div class="control-group">
		{{ Form::label('username', 'E-Mail Address', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
	    {{ Form::email('username', null, array('class' => 'required email', 'autofocus'=>'autofocus')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
	    {{ Form::label('password', 'Password', array('class' => 'control-label')); }}
	    <div class="controls">
	    <div class="input-prepend"> <span class="add-on"><i class="icon-lock"></i></span>
	    {{ Form::password('password', array('class' => 'required')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
			<label class="control-label" for="optionsCheckbox">Remember me</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" name="remember" id="remember" value="1">
				</label>
			</div>
		</div>
	    
	    <div class="control-group">
	    <div class="controls">
	    {{ Form::submit('Submit', array('class' => 'btn btn-primary'));}}
	    </div>
	    </div>
	    <a href="/password/remind">Forgot password?</a>
		<input type="hidden" name="targetUrl" value="{{ Session::get('targetUrl') }}">


	{{ Form::close() }}

	</div>
	
	
	

<!-- end row-fluid-->
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
});
</script>
@stop