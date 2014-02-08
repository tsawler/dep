@extends('layout')

@section('browser-title')
User: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
		
			<h3 class="short_headline" style="text-transform: none;"><span>User: {{ $user->first_name }} {{ $user->last_name }}</span></h3>
		    
		    
		    {{ Form::model($user, array(
										'class' => 'form-horizontal', 
										'name' => 'bookform', 'id' => 'bookform',
										'url' => array('admin/edituser', $user->id )
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
			
			
			
			<div class="control-group">
			<div class="controls">
			{{ Form::submit('Save', array('class' => 'btn btn-primary')); }}
			<button type="reset" class="btn">Reset</button>
			</div>
			</div>
			
			{{ Form::close() }}
			
			
			
			@if ($user->access_level == 3)
				
				<p>&nbsp;</p>
				<h3 class="short_headline"><span>Roles</span></h3>
				
				{{ Form::model($user->roles, array(
											'class' => 'form-horizontal', 
											'name' => 'roleform', 'id' => 'roleform',
											'url' => array('/admin/edituserroles', $user->id )
											) 
							   )
				}}
				
				@foreach (Role::all() as $role)
					
					<?php
					$hasRole = false;
					if ($user->roles->contains($role->id))
						$hasRole = true;
					?>
					<div class="control-group">
						<label class="control-label" for="{{ 'r_'.$role->id }}">{{ $role->role_name }}</label>
						<div class="controls">
							<label class="checkbox">
								{{ Form::checkbox('r_'.$role->id, $role->id, $hasRole); }}
							</label>
						</div>
					</div>
				@endforeach
				
				<div class="control-group">
				<div class="controls">
				{{ Form::submit('Save', array('class' => 'btn btn-primary')); }}
				<button type="reset" class="btn">Reset</button>
				</div>
				</div>
				
				{{ Form::close() }}
			@endif
			
			<p>&nbsp;</p>
			
			<h3 class="short_headline"><span>Submissions</span></h3>
			@if ( ! $submissions->isEmpty() )
				<table class='responsive table table-striped table-bordered'>
						<thead>
							<tr>
								<th>Title</th>
								<th>Author/Pen name</th>
								<th>Submitted</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
					@foreach($submissions as $submission)
				        <tr>
				        	<td>{{ $submission->manuscript_title }}
				        	<td>{{ $submission->pen_name }}</td>
				        	
				        	<td>{{ $submission->created_at->format('l, F jS Y, g:i A e') }}
				        	
				        	<td>
				        	@if ($submission->status == 1)
				        	<span class='inqueue tt' 
				        		  title='Your manuscript is in our review queue, and we&apos;ll be getting to it as soon as we can.'>
				        		  Awaiting Review
						    </span>
						    @elseif ($submission->status == 2)
						    <span class='inreview tt' 
				        		  title='Your manuscript currently being reviewed by our team.'>
				        		  In Review
						    </span>
						    @elseif ($submission->status == 3)
						    <span class='accepted tt' 
				        		  title='Your manuscript has been accepted! Congratualtions!'>
				        		  Accepted
						    </span>
						    @else
						    <span class='rejected tt' 
				        		  title='Your manuscript has not been accepted.'>
				        		  Not accepted
						    </span>
						    @endif
				        </tr>
				    @endforeach
				</table>
			@else
				No manuscript submissions.
			@endif
			
			<p>&nbsp;</p>
			
			<h3 class="short_headline"><span>Purchases</span></h3>
			
			@if ( ! $purchased->isEmpty() )
				<!-- todo -->
			@else
				No purchases.
			@endif
			
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop