@extends('layout')

@section('browser-title')
Password Change: The Dog Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Security</span></h3>
			
			
			{{ Form::open(array('url' => 'users/security', 'class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
			    
			    <img src="{{ $qrCodeUrl }}"><br><br>
			    
			    <hr>
			    
			    <div class="control-group">
			    <div class="controls">
			    {{ Form::submit('Update', array('class' => 'btn btn-primary'));}}
			    </div>
			    </div>
			    
		    {{ Form::close() }}
		    
		</div> <!-- /span9 primary column -->
	
		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li><a href='/users/dashboard'>Dashboard</a></li>
						<li><a href='/users/account'>Your Account</a></li>
						<li><a href="/users/author">Author Details</a></li>
						<li><a href='/users/password'>Change Password</a></li>
						<li><a href="/users/security"><strong>Security</strong></a></li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
	</div>
</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		rules: {
			new_password: {
				required: true,
				minlength: 6,
				maxlength: 32
			},
			new_password_confirmation: {
				required: true,
				equalTo: "#new_password"
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