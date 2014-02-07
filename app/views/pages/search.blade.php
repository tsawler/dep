@extends('layout')

@section('browser-title')
Search: The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="Search the Dog-Eared Press" />
@stop


@section('content')

<div class="container">

	<h3 class="short_headline" style="text-transform: none;"><span id="editablecontenttitle">Search</span></h3>

	{{ Form::open(array('url' => 'search', 'class' => 'form-inline', 'method' => 'post')) }}
	

	{{ Form::text('searchterm', $searchterm, array('id' => 'search-box', 'placeholder' => 'Search')); }}
	{{ Form::submit('Search', array('class' => 'btn btn-primary')); }}

	
	{{ Form::close() }}
	
<p>&nbsp;</p>	

</div>
@stop