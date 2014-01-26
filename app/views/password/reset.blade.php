@extends('layout')

@section('content')
    <h1>Set Your New Password</h1>

    {{ Form::open(array('class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="control-group">
		{{ Form::label('email', 'E-Mail Address', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
	    {{ Form::email('email', null, array('class' => 'required email')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('password', 'Password', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class='icon icon-lock'></i></span>
	    {{ Form::password('password', null, array('class'=>'required')) }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class='icon icon-lock'></i></span>
	    {{ Form::password('password_confirmation', null, array('class'=>'required')) }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
	    <div class="controls">
	    {{ Form::submit('Reset Password', array('class' => 'btn btn-primary'));}}
	    </div>
	    </div>
	    
    {{ Form::close() }}

    @if (Session::has('error'))
        <p style="color: red;">{{ Session::get('error') }}</p>
    @endif
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		rules: {
			password: {
				required: true,
				minlength: 6,
				maxlength: 32
			},
			password_confirmation: {
				required: true,
				equalTo: "#password"
			}
		},
		highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-inline',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
});
</script>
@stop
