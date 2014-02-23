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
			<p class="clearfix"> You can contact us through email, phone, or by using the form below. Since we are in the early
			stages of development right now, you'll probably have better luck using email or the form than the phone. If you call,
			we will call you back, but it might take a day or two.  </p>
			<hr />
			<div class="span5">

				<p><strong>The Dog-Eared Press</strong><br>
					PO Box 1234<br>
					Fredericton, New Brunswick<br>
					Canada E3B 1B1<br>
					<strong>phone:</strong> <a href="tel:8135551234" class="tele">506.474.2704</a><br>
					<strong>email:</strong> <a href="mailto:query@dogearedpress.ca">query@dogearedpress.ca</a> </p>
				<h3 class="short_headline margin-top"><span>Stay in Touch</span></h3>
				<section>
					<p>Sign up for our newsletter. We won't share your email address.</p>
					{{ Form::open(array('url' => '/joinlist', 'class' => 'form-horizontal', 'method' => 'post')) }}
						<div class="input-append row-fluid">
							{{ Form::text('email', null, array('id' => 'span10 required email', 'placeholder' => 'you@example.com')); }}
							{{ Form::submit('Sign up', array('class' => 'btn btn-primary')); }}
						</div>
						<!--close input-append-->
					{{ Form::close() }}
				</section>
				<!--close input-append-->
				<h3 class="short_headline margin-top"><span>Follow Us</span></h3>
				<ul class="social">
					<li><a class="socicon rss" href="/blog.rss" title="RSS"></a></li>
					<li><a class="socicon facebook" href="https://www.facebook.com/dogearedpress" title="Facebook"></a></li>
					<li><a class="socicon twitterbird" href="https://twitter.com/dogearedpress" title="Twitter"></a></li>
				</ul>
			</div>
			<!--close span5 -->
			
			<div class="span7">
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