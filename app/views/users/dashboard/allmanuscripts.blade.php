@extends('layout')

@section('browser-title')
Manuscripts: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Manuscripts</span></h3>
			
			{{ Form::open(array('url' => 'admin/allusers', 'class' => 'form-inline', 'name' => 'bookform', 'id' => 'bookform')) }}
			
			{{  Form::text('manuscript_title', $manuscript_title, array('placeholder'=>'Title', 
				'id' => 'last_name', 'autocomplete' => 'off'));}}
			
			{{ Form::submit('Filter', array('class' => 'btn btn-primary')); }}
			
			{{ Form::close() }}
			
			<table id="mans" class="responsive table table-striped table-bordered">
					<thead>
						<tr>
							<th> Title </th>
							<th> Date </th>
						</tr>
					</thead>
					
					<tbody>
					@foreach ($manuscripts as $manuscript)
						<tr>
							<td><a href="/admin/showmanuscript/{{$manuscript->id }}">{{ $manuscript->manuscript_title }}</a></td>
							<td>{{ $manuscript->created_at }}</td>
						</tr>
					@endforeach
					</tbody>
			</table>
			<div class="pagination">
			{{ $manuscripts->links() }}
			</div>
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop

@section('bottom-js')
<script>
/*$(document).ready(function() {
    $('#mans').dataTable();
} );*/
</script>
@stop