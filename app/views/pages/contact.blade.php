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
					<li><a class="socicon facebook" href="#" title="Facebook"></a></li>
					<li><a class="socicon twitterbird" href="#" title="Twitter"></a></li>
				</ul>
			</div>
			<!--close span5 -->
			
			<div class="span7">
				{{ Form::open(array('url' => '/contactus', 
									'class' => 'form-horizontal', 
									'name' => 'bookform', 
									'id' => 'bookform',
									'method' => 'post')) }}
					<fieldset>
						<div class="control-group">
							{{ Form::label('name', 'Your Name'); }}
							{{ Form::text('name', null, array('class' => 'span10 required')); }}
						</div>
						<div class="control-group">
							{{ Form::label('phone', 'Phone Number'); }}
							{{ Form::text('phone', null, array('class' => 'span10'	)); }}
						</div>
						<div class="control-group">
							{{ Form::label('email', 'Email Address'); }}
							{{ Form::text('email', null, array('class' => 'span10', 'placeholder' => 'you@example.com')); }}
						</div>
						<div class="control-group">
							{{ Form::label('message', 'Your Message'); }}
							{{ Form::textarea('message', null, array('class' => 'span10 required')); }}
						</div>
						<div class="control-group">
						<img src="{{ $builder->inline() }}" /><br>
						Enter the characters you see above</label>
						<input type="text" class="span10 required" name="captcha" id="captcha" />
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