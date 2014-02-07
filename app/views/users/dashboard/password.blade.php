@extends('layout')

@section('browser-title')
Password Change: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Update Password</span></h3>
			
			
			{{ Form::open(array('class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
			    
			    <div class="control-group">
				{{ Form::label('password', 'Old Password', array('class' => 'control-label')); }}
				<div class="controls">
				<div class="input-prepend"> <span class="add-on"><i class='icon icon-lock'></i></span>
			    {{ Form::password('password', null, array('class'=>'required')) }}
			    </div>
			    </div>
			    </div>
			    
			    <div class="control-group">
				{{ Form::label('new_password', 'New Password', array('class' => 'control-label')); }}
				<div class="controls">
				<div class="input-prepend"> <span class="add-on"><i class='icon icon-lock'></i></span>
			    {{ Form::password('new_password', null, array('class'=>'required')) }}
			    </div>
			    </div>
			    </div>
			    
			    <div class="control-group">
				{{ Form::label('new_password_confirmation', 'Confirm New Password', array('class' => 'control-label')); }}
				<div class="controls">
				<div class="input-prepend"> <span class="add-on"><i class='icon icon-lock'></i></span>
			    {{ Form::password('new_password_confirmation', null, array('class'=>'required')) }}
			    </div>
			    </div>
			    </div>
			    
			    <hr>
			    
			    <div class="control-group">
			    <div class="controls">
			    {{ Form::submit('Update Password', array('class' => 'btn btn-primary'));}}
			    </div>
			    </div>
			    
		    {{ Form::close() }}
		    
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
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