@extends('layout')

@section('browser-title')
Users: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>All Users</span></h3>
			
			<table id="users" class="responsive table table-striped table-bordered">
					<thead>
						<tr>
							<th> Last name </th>
							<th> First Name </th>
							<th> Email </th>
							<th> Status </th>
						</tr>
					</thead>
					
					<tbody>
					
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
    $('#users').dataTable({
    	"sPaginationType": "bootstrap",
    	"bProcessing": true,
    	"bStateSave": true,
    	"bFilter": true,
    	"sAjaxSource": '/admin/allusersajax'
    });
     /*$('#users').dataTable({
    	"sPaginationType": "bootstrap",
    	"bProcessing": true,
    	"bStateSave": true,
    	"bFilter": true
    });*/
});	
</script>
@stop