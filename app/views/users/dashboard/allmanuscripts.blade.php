@extends('layout')

@section('browser-title')
Manuscripts: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Manuscripts</span></h3>
			
			
			
			<table id="mans" class="responsive table table-striped table-bordered">
					<thead>
						<tr>
							<th> Title </th>
							<th> Author </th>
							<th> Date </th>
							<th> Status </th>
						</tr>
					</thead>
					
					<tbody>
					@foreach ($manuscripts as $manuscript)
						<tr>
							<td><a href="/admin/managems/{{ $manuscript->id }}">{{ $manuscript->manuscript_title }}</a></td>
							<td>{{ $manuscript->users->last_name }}
							<td>{{ date("j M Y", strtotime($manuscript->created_at)) }}</td>
							<td>{{ $manuscript->statuses->status_name }}</td>
							
						</tr>
					@endforeach
					</tbody>
			</table>
			
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function(){
    $('#mans').dataTable({
    	"sPaginationType": "bootstrap",
    	"bProcessing": true,
    	"bStateSave": true,
    	"bFilter": true});
});	
</script>
@stop