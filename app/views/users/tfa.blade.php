@extends('layout')

@section('browser-title')
Log in to your account: The Dog Eared Press
@stop

@section('meta')
<meta name="description" content="Submit a manuscript to the Dog Eared Press, an independent publisher of fantasy eBooks." />
@stop


@section('content')

	<div class="container">
		<h3 class="short_headline" style="text-transform: none;"><span>Validation Code</span></h3>

	{{ Form::open(array('url' => 'users/checktfa', 'class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}

		<div class="control-group">
		{{ Form::label('tfa', 'Enter your validation code', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-lock"></i></span>
	    {{ Form::text('tfa', null, array('class' => 'required digits', 'autofocus'=>'autofocus')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
	    <div class="controls">
	    {{ Form::submit('Submit', array('class' => 'btn btn-primary'));}}
	    </div>
	    </div>

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