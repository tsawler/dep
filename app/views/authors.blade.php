@extends('layout')

@section('browser-title')
Authors: The Dog Eared Press
@stop



@section('content')

<div class="row-fluid reverse-order"> 

	<h3 class="short_headline" style="text-transform: none;"><span>Authors</span></h3>
	
	<table class='responsive table table-striped table-bordered'>
		<thead>
			<tr>
				<th>Author Name</th>
				<th>City</th>
			</tr>
		</thead>
		<tbody>
	@foreach($authors as $author)
        <tr>
        	<td>{{ $author->pen_name }}</td>
        	<td>{{ $author->city }}</td>
        </tr>
    @endforeach
    	</table>
	
	
</div>
<!-- end row-fluid-->
@stop