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
			<li><strong>Manuscript Title</strong>: {{ $manuscript->manuscript_title }}
			<li><strong>Author</strong>: <a href="/admin/edituser/{{ $manuscript->user_id }}">{{ $manuscript->users->first_name }} {{ $manuscript->users->last_name }}</a></li>
			<li><strong>Pen name</strong>: {{ $manuscript->pen_name }}</li>
		    <li><strong>Email</strong>: <a href="mailto:{{ $manuscript->users->email }}">{{ $manuscript->users->email }}</a></li>
		    <li><strong>Date submitted</strong>: {{ date("l, F jS, Y", strtotime($manuscript->created_at)) }}
			</ul>
			
			<a class="btn" href="/admin/showmanuscript/{{$manuscript->id }}">Download Manuscript</a> 
			<a href="javascript:void()" id="coverletter" class="btn" onclick="cl(); return false;">Show cover letter</a>
			
			
			<div id="cl" class="hidden">
			<hr>
			{{ nl2br($manuscript->cover_letter) }}
			</div>
			
			<hr>
			
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
					'3' => 'Conditionally Accepted',
					'4' => 'Accepted',
					'5' => 'Rejected'
					),
					$manuscript->status,
					array('id' => 'status')
				)}} <button type="submit" class="btn btn-small" onclick="updateStatus(); return false;">Update Status</button>
				
				<input type="hidden" id="oldstatus" name="oldstatus" value="{{ $manuscript->status }}">
				<input type="hidden" name="id" value="{{ $manuscript->id }}">
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
		bootbox.confirm("Are you sure you want to change the status to <strong>" + $("#status option:selected").text() + "</strong>?", function(result) {
			if (result) {
				$("#bookform").submit();
			}
		});
	} else {
		bootbox.alert("Status has not changed");
	}
}
function cl(){
	if ($("#cl").hasClass("hidden")) {
		$("#cl").removeClass("hidden");
		$("#coverletter").html("Hide cover letter");
	} else {
		$("#cl").addClass("hidden");
		$("#coverletter").html("Show cover letter");
	}
}
$(document).ready(function () {	
	
});
</script>
@stop