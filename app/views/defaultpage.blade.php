@extends('layout')

<?php
$page_id = Request::segment(2);

$my_id = 0;
$my_access_level = 0;
$page_title = "Not active";
$page_content = "The page you have requested is not active.";
$meta = "";
$active = 0;

$results = DB::select('select * from pages where id = ?', array($page_id));

foreach ($results as $result)
{
	$active = $result->active;
	if ($active > 0){
    	$page_title = $result->page_title;
		$page_content = $result->page_content;
		$meta = $result->meta;
    }
}
if(Auth::check()){
	$my_id = Auth::user()->id;
	$my_access_level = Auth::user()->access_level;
}
?>

@section('browser-title')
{{ $page_title }}: The Dog Eared Press
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
	<form action="/saveeditedpage" method="post" id="savetitledata" name="savetitledata">
	<div class="hidden" id="savetitlebar" style='margin-bottom: 5px;'>
	<div class='pull-right'>
	<a href='#!' style='text-decoration: none;'><i class="icon-remove-sign" onclick="turnOffEditing()"></i></a>&nbsp;
	<a href='#!' onclick='savePageChanges()' style='text-decoration: none;'><i class="icon-save" onclick="saveEditedPage()"></i></a>
	</div>
	</div>
	<div style="clear: both; margin-bottom: 5px;"></div>
	<form action="/savepagetitle" method="post" id="savetitledata" name="savetitledata">
	<h3 class="short_headline" style="text-transform: none;">
	<article id="editablecontenttitle" style='width: 100%'>
	<span>{{ $page_title }}</span>
	</article>
	</h3>
	<input type="hidden" name="page_id" value="{{ $page_id }}">
	<input type="hidden" name="thetitledata" id="thetitledata">
	<article id="editablecontent" itemprop="description" style='width: 100%'>
	{{ $page_content }}
	</article>
	<input type="hidden" name="thedata" id="thedata">
	</form>
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