@extends('layout')

@section('content')

<div class="container">
{{ Form::open(array('url' => 'users/create', 'class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
<h3 class="short_headline" style="text-transform: none;"><span>Create an Account</span></h3>

<p>To create a free account, just fill out the form below. You will need an account in order to purchase books, or to submit a manuscript for consideration.</p>


<div class="control-group">
{{  Form::label('first_name', 'First Name', array('class' => 'control-label')); }}
<div class="controls">
<div class="input-prepend"> <span class="add-on"><i class="icon icon-font"></i></span>
{{  Form::text('first_name', null, array('class'=>'required','autofocus'=>'autofocus'));}}
</div>
</div>
</div>

<div class="control-group">
{{  Form::label('last_name', 'Last Name', array('class' => 'control-label')); }}
<div class="controls">
<div class="input-prepend"> <span class="add-on"><i class="icon icon-font"></i></span>
{{  Form::text('last_name', null, array('class'=>'required'));}}
</div>
</div>
</div>


<div class="control-group">
{{ Form::label('email', 'Email Address', array('class' => 'control-label')); }}
<div class="controls">
<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
{{ Form::email('email', null, array('class'=>'required email')); }}
<span class='help-inline'></span>
</div>
</div>
</div>

<div class="control-group">
{{ Form::label('verify_email', 'Verify Email', array('class' => 'control-label')); }}
<div class="controls">
<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
{{ Form::email('verify_email', null, array('class'=>'required email')) }}
<span class='help-inline'></span>
</div>
</div>
</div>

<div class="control-group">
{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
<div class="controls">
<div class="input-prepend">
<span class="add-on"><i class="icon-lock"></i></span>
{{ Form::password('password', null, array('class'=>'required')); }}
<span class='help-inline'></span>
</div>
</div>
</div>

<div class="control-group">
{{ Form::label('password_confirmation', 'Verify Password', array('class' => 'control-label')) }}
<div class="controls">
<div class="input-prepend">
<span class="add-on"><i class="icon-lock"></i></span>
{{ Form::password('password_confirmation', null, array('class'=>'required')); }}
<span class='help-inline'></span>
</div>
</div>
</div>

<div class="control-group">
<div class="controls">
{{ Form::submit('Create Account', array('class' => 'btn btn-primary')); }}
</div>
</div>

{{ Form::close() }}

</div>
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
			},
			verify_email: {
				required: true,
				equalTo: "#email",
				email: true
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