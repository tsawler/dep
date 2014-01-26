@extends('layout')

@section('content')
    <h1>Need to reset your password?</h1>

    {{ Form::open(array('class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
        <div class="control-group">
		{{ Form::label('email', 'E-Mail Address', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
	    {{ Form::email('email', null, array('class' => 'required email')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
	    <div class="controls">
	    {{ Form::submit('Request Password Reset', array('class' => 'btn btn-primary'));}}
	    </div>
	    </div>
	    
    {{ Form::close() }}

    @if (Session::has('error'))
        <div class="alert alert-error">{{ Session::get('error') }}</div>
    @elseif (Session::has('status'))
        <div class="alert alert-error">{{ Session::get('status') }}</div>
    @endif
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

