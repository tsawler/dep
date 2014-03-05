@extends('layout')

@section('browser-title')
Manage Manuscript: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Manuscript: {{ $manuscript->manuscript_title }}</span></h3>
			
			<ul>
			<li><strong>Manuscript Title</strong>: {{ $manuscript->manuscript_title }} [ <a href="/admin/showmanuscript/{{$manuscript->id }}">Download</a> ]
			<li><strong>Author</strong>: <a href="/admin/edituser/{{ $manuscript->user_id }}">{{ $manuscript->users->first_name }} {{ $manuscript->users->last_name }}</a></li>
			<li><strong>Pen name</strong>: {{ $manuscript->pen_name }}</li>
		    <li><strong>Email</strong>: <a href="mailto:{{ $manuscript->users->email }}">{{ $manuscript->users->email }}</a></li>
		    <li><strong>Date submitted</strong>: {{ date("l, F jS, Y", strtotime($manuscript->created_at)) }}
			</ul>
			
			{{ Form::open(array(
				'url' => 'admin/manuscriptstatus', 
				'files' => true, 
				'method' => 'post',
				'class' => 'form-horizontal', 
				'name' => 'bookform', 
				'id' => 'bookform')) }}
				
				{{ Form::select('status', array(
					'1' => 'In Queue',
					'2' => 'In Review',
					'3' => 'Accepted',
					'4' => 'Rejected'
					),
					$manuscript->status
				)}} <button type="submit" class="btn btn-small" onclick="updateStatus(); return false;">Update Status</button>
				
				<input type="hidden" name="oldstatus" value="{{ $manuscript->status }}">
			{{ Form::close() }}
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop

@section('bottom-js')
<script>
function updateStatus(){
	if ($("#oldstatus").val() != $("#status").val()){
		bootbox.confirm("Are you sure you want to change the status? The author will receive an email. It's probably not great way to turn a manuscript down.... ", function(result) {
			if (result) {
					//$("#bookform").submit();
			}
		});
	} else {
		bootbox.alert("Status has not changed");
	}
}
$(document).ready(function () {	
	
});
</script>
@stop