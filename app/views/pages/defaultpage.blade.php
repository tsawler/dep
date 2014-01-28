@extends('layout')

@section('browser-title')
{{ strip_tags($page_title) }}: The Dog Eared Press
@stop

@section('meta')
<meta name="description" content="{{ $meta }}" />
@stop


@section('content')

<div class="row-fluid reverse-order"> 

	
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
	<!--
	<div class="admin-hidden" id="savetitlebar" style='margin-bottom: 5px;'>
	<div class='pull-right'>
	<a href='#!' style='text-decoration: none;'><i class="icon-remove-sign" onclick="turnOffEditing()"></i></a>&nbsp;
	<a href='#!' onclick='savePageChanges()' style='text-decoration: none;'><i class="icon-save" onclick="saveEditedPage()"></i></a>
	</div>
	</div>
	<div style="clear: both; margin-bottom: 5px;"></div>
	-->
	<form action="/savepagetitle" method="post" id="savetitledata" name="savetitledata">
	<h3 class="short_headline" style="text-transform: none;">
	<article id="editablecontenttitle" style='width: 100%'>
	{{ $page_title }}
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
	<h3 class="short_headline" style="text-transform: none;"><span>{{ $page_title}}</span></h3>
	{{ $page_content }}
@endif
@endif

@if(!Auth::check())
	<h3 class="short_headline" style="text-transform: none;"><span>{{ $page_title }}</span></h3>
	{{ $page_content }}
@endif

<p>&nbsp;</p>	
	
</div>
<!-- end row-fluid-->
@stop