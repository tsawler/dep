@extends('layout')

@section('browser-title')
Password Change: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>User: {{ $user->first_name }} {{ $user->last_name }}</span></h3>
		    
		    
		    {{ Form::model($user, array(
										'class' => 'form-horizontal', 
										'name' => 'bookform', 'id' => 'bookform',
										'url' => array('admin/editadminuser', $user->id )
										) 
						   )
			}}
			
			
			<div class="control-group">
			{{  Form::label('first_name', 'First Name', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-font"></i></span>
			{{  Form::text('first_name', null, array('class'=>'required'));}}
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
			{{  Form::label('access_level', 'Admin User?', array('class' => 'control-label')) }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon-lock"></i></span>
			{{ Form::select('access_level', array(
				'3' => 'Yes',
				'1' => 'No')
				) }}
			</div>
			</div>
		    </div>
		    
		    <div class="control-group">
			{{  Form::label('user_active', 'Active?', array('class' => 'control-label')) }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon-lock"></i></span>
			{{ Form::select('user_active', array(
				'1' => 'Yes',
				'0' => 'No')
				) }}
			</div>
			</div>
		    </div>
			
			<hr>
			
			<div class="control-group">
			<div class="controls">
			{{ Form::submit('Save', array('class' => 'btn btn-primary')); }}
			<button type="reset" class="btn">Cancel</button>
			</div>
			</div>
			
			{{ Form::close() }}
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop