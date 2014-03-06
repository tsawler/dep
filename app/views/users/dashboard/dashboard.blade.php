@extends('layout')

@section('browser-title')
Dashboard: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Your Submitted Manuscripts</span></h3>
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
				        	<td>{{ $submission->statuses->status_name }}</td>
				        </tr>
				    @endforeach
				</table>
			@else
			You haven't submitted any manuscripts yet.
			@endif
			
			<p>&nbsp;</p>
			<h3 class="short_headline" style="text-transform: none;"><span>Your Purchased Books</span></h3>
			@if ( ! $purchased->isEmpty() )
				<!-- todo -->
			@else
				You haven't purchased any books yet.
			@endif
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$('.tt').tooltip();
});
function deleteItem(x){
	bootbox.confirm("Are you sure you want to delete this item?", function(result) {
		if (result) {
			location.href='/users/deletemanuscript?id='+x;
		}
	});
}
</script>
@stop