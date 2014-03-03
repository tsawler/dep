@extends('layout')


@section('browser-title')
Contact Us: The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="Contact the Dog-eared Press, an independent publisher of Fantasy eBooks." />
@stop


@section('content')

<div class="container">
	

	<h3 class="short_headline" style="text-transform: none;"><span id="editablecontenttitle">Contact the Dog-Eared Press</span></h3>
		<div class="row-fluid reverse-order contact-page">

			<p>If you'd like to get in touch, just fill out the form below and we'll get back to you as soon as we can. We'd love to hear
			from you.</p>
			
			<div class="span12">
				{{ Form::open(array('url' => '/contactus', 
									'class' => 'form', 
									'name' => 'bookform', 
									'id' => 'bookform',
									'method' => 'post')) }}
					<fieldset>
						
						<div class="control-group">
						{{ Form::label('name', 'Your name', array('class' => 'control-label')); }}
						<div class="controls">
						<div class="input-prepend"> <span class="add-on"><strong>A</strong></span>
						{{ Form::text('name', null, array('class'=>'input-xlarge required')); }}
						<span class='help-inline'></span>
						</div>
						</div>
						</div>
						
						<div class="control-group">
						{{ Form::label('email', 'Email Address', array('class' => 'control-label')); }}
						<div class="controls">
						<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
						{{ Form::email('email', null, array('class'=>'input-xlarge required email')); }}
						<span class='help-inline'></span>
						</div>
						</div>
						</div>
						
						<div class="control-group">
						{{ Form::label('message', 'Message', array('class' => 'control-label')); }}
						<div class="controls">
						{{ Form::textarea('message', null, array('rows'=>'3','class'=>'input-xxlarge required')); }}
						<span class='help-inline'></span>
						</div>
						</div>

						
						<div class="control-group">
						<label><img src="{{ $builder->inline() }}" /><br>
						Enter the characters you see above</label>
						<div class="input-prepend"> <span class="add-on"><i class="icon-lock"></i></span>
						<input type="text" class="span10 required" name="captcha" id="captcha" />
						</div>
						</div>
						
						<button type="submit" class="btn btn-primary btn-large">Send</button>
					</fieldset>
				{{ Form::close() }}
			</div>
			<!--close span7 --> 
		</div>
		<!--close row-fluid-->


<p>&nbsp;</p>	

</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	jQuery.validator.messages.required = "";
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