@extends('layout')

@section('browser-title')
Dashboard: Account Details: The Dog Eared Press
@stop

@section('content')
<div class="row-fluid reverse-order"> 
	<div class="span12">
	 	@if(Session::has('message'))
			<div id="editmsg" class='alert alert-success'>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('message') }}
			</div>
		@endif
	</div>
</div>



	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			

			<h3 class="short_headline" style="text-transform: none;"><span>Account Details</span></h3>
			
			<p>Please note that if you <strong>change your email</strong>, you will have to
			<strong>use the new email to log in</strong> to the site.</p>
			
			{{ Form::model($user, array(
										'class' => 'form-horizontal', 
										'name' => 'bookform', 'id' => 'bookform',
										'url' => array('users/account', $user->id )
										) 
						   )
			}}
			
			<ul>
			  @foreach($errors->all() as $error)
			     <li>{{ $error }}</li>
			  @endforeach
			</ul>
			
			
			
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
			{{ Form::label('verify_email', 'Verify Email', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="socicon email"></i></span>
			{{ Form::email('verify_email', null, array('class'=>'required email')) }}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>

		
			<hr>
			
			<div class="control-group">
			<div class="controls">
			{{ Form::submit('Save Account Details', array('class' => 'btn btn-primary')); }}
			<button type="reset" class="btn">Cancel</button>
			</div>
			</div>
			
			{{ Form::close() }}
		</div> <!-- /span9 primary column -->
	
		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li><a href='/users/dashboard'>Dashboard</a></li>
						<li><a href='/users/account'><strong>Your Account</strong></a></li>
						<li><a href='/users/password'>Change Password</a></li>
						<li><a href="/users/author">Author Details</a></li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
	</div>


@stop