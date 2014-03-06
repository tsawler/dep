@extends('layout')

@section('browser-title')
Pages: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>All Users</span></h3>
			
			<table id="pages" class="responsive table table-striped table-bordered">
					<thead>
						<tr>
							<th> Page name </th>
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
    $('#pages').dataTable({
    	"sPaginationType": "bootstrap",
    	"bProcessing": true,
    	"bStateSave": true,
    	"bFilter": true,
    	"sAjaxSource": '/admin/allpagesajax'
    });
});	
</script>
@stop