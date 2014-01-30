@extends('layout')

@section('browser-title')
Dashboard: The Dog Eared Press
@stop

@section('content')

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
			You haven't submitted any manuscripts yet.
			@endif
			
			<p>&nbsp;</p>
			<h3 class="short_headline" style="text-transform: none;"><span>Your Purchased Books</span></h3>
			@if ( ! $purchased->isEmpty() )
			
			@else
			You haven't purchased any books yet.
			@endif
		</div> <!-- /span9 primary column -->
	
		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li><a href='/users/dashboard'><strong>Dashboard</strong></a></li>
						<li><a href='/users/account'>Your Account</a></li>
						<li><a href='/users/password'>Change Password</a></li>
						<li><a href="/users/author">Author Details</a></li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
	</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$('.tt').tooltip();
});
</script>
@stop