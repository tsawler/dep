@extends('layout')

@section('browser-title')
Admin Users: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Admin Users</span></h3>
			
			
			<table class="responsive table table-striped table-bordered">
					<thead>
						<tr>
							<th> Last name </th>
							<th> First Name </th>
							<th> Email </th>
							<th> Status </th>
						</tr>
					</thead>
					
					<tbody>
					@foreach ($adminusers as $user)
						<tr>
							<td><a href="/admin/edituser/{{$user->id }}">{{ $user->last_name }}</a></td>
							<td>{{ $user->first_name }}</td>
							<td>{{ $user->email }}</td>
							@if($user->user_active == 1)
							<td><span style="color: green;">Active</span></td>
							@else
							<td><span style="color: red;">Inactive</span></td>
							@endif
						</tr>
					@endforeach
					</tbody>
			</table>
			
			<div class="pagination">
			{{ $adminusers->links(); }}
			</div>
		    
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop