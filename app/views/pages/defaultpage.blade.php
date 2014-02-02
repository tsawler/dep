@extends('layout')

@section('browser-title')
{{ $page_title }}: The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="{{ $meta }}" />
@stop


@section('content')

<div class="container">
	
@if(Auth::check())
@if(Auth::user()->access_level == 3)
	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>
@endif
@endif
	
@if(Auth::check())
@if(Auth::user()->access_level ==3)

	{{ Form::open(array('url' => 'page/edit', 'id' => 'savetitledata', 'name' => 'savetitledata')) }}
	<form action="/savepagetitle" method="post" id="savetitledata" name="savetitledata">
	<h3 class="short_headline" style="text-transform: none;">
	<article style='width: 100%'>
	<span id="editablecontenttitle">{{ $page_title }}</span>
	</article>
	</h3>
	<input type="hidden" name="page_id" value="{{ $page_id }}">
	<input type="hidden" name="thetitledata" id="thetitledata">
	<article id="editablecontent" itemprop="description" style='width: 100%'>
	{{ $page_content }}
	</article>
	<article class="admin-hidden">
		<a class="btn btn-primary" href="#!" onclick="saveEditedPage()">Save</a>
		<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
		&nbsp;&nbsp;&nbsp;
		<!-- <a class="btn btn-danger" href="#!" onclick="deletePaget()">Delete</a> -->
	</article>
	<input type="hidden" name="thedata" id="thedata">
	{{ Form::close() }}
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
	<h3 class="short_headline" style="text-transform: none;"><span id="editablecontenttitle">{{ $page_title}}</span></h3>
	{{ $page_content }}
@endif
@endif

@if(!Auth::check())
	<h3 class="short_headline" style="text-transform: none;"><span id="editablecontenttitle">{{ $page_title }}</span></h3>
	{{ $page_content }}
@endif

<p>&nbsp;</p>	

</div>
@stop