@extends('layout')

@section('browser-title')
The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="The Dog-eared Press is an independent publisher of Fantasy and Science Fiction eBooks." />
<link rel="stylesheet" href="/assets/css/boxed-slider-flexslider.css" type="text/css" media="screen" />
@stop

@section('content')

<div class="hero-unit center no-border no-padding-bottom">
	<div class="container"> 
		<h1>Welcome to the Dog-Eared Press</h1>
	</div>
	<!--close container--> 
</div>
<!--close hero-unit-->


<div class="container">
@if(Auth::check())
@if((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(1)))
	<div id="editmsg" class='alert alert-success hidden'>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<span id="theeditmsg"></span>
	</div>

	<div class="admin-hidden" id="savebar" style='margin-bottom: 5px;'>
		<div class='pull-right'>
			<a href='#!' style='text-decoration: none;'><i class="icon-remove-sign" onclick="turnOffEditing()"></i></a>&nbsp;
			<a href='#!' style='text-decoration: none;'><i class="icon-save" onclick="saveChanges()"></i></a>
		</div>
	</div>
	<div style="clear: both; margin-bottom: 5px;"></div>

	{{ Form::open(array('url' => 'page/edit', 'id' => 'savedata', 'name' => 'savedata')) }}
		<article id="editablecontent" style='width: 100%'>
	{{ $page_content }}
	</article>
	<article class="admin-hidden">
		<br>
		<a class="btn btn-primary" onclick="saveChanges()()">Save</a>
		<a class="btn btn-info" onclick="turnOffEditing()">Cancel</a>
		&nbsp;&nbsp;&nbsp;
	</article>
	<input type="hidden" name="page_id" value="<?php echo $page_id;?>">
	<input type="hidden" name="thedata" id="thedata">
	<input type="hidden" name="thetitledata" value="{{ $page_title }}">
	{{ Form::close() }}
	
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
	{{ $page_content }}
@endif
@endif

@if(!Auth::check())
	{{ $page_content }}
@endif

<div class="row-fluid">
	<div class="rotating-testimonials span12">
		<h3 class="short_headline" style="text-transform: none;"><span>Why read fantasy?</span></h3>
		<div class="panels">
			<div id="t1">
			<blockquote>
			<p>Stories of imagination tend to upset those without one.</p>
			<footer>Terry Pratchett</footer>
			</blockquote>
			</div>
			<div id="t2">
			<blockquote>
			<p>Science fiction deals with improbable possibilities, fantasy with plausible impossibilities.</p>
			<footer>Miriam Allen de Ford</footer>
			</blockquote>
			</div>
			<div id="t3">
			<blockquote>
			<p>Fantasy is escapist, and that is its glory. If a soldier is imprisoned by the enemy, don't we consider it his duty to escape?. . .
			If we value the freedom of mind and soul, if we're partisans of liberty, then it's our plain duty to escape, and to take as many people 
			with us as we can!</p>
			<footer>J.R.R. Tolkien</footer>
			</blockquote>
			</div>
			<div id="t4">
			<blockquote>
			<p>Humanity's a nice place to visit, but you wouldn't want to live there.</p>
			<footer>Terry Pratchett</footer>
			</blockquote>
			</div>
		</div>
		<ul class="tabs">
			<li class="tab"><a href="#t1">Terry Pratchett</a></li>
			<li class="tab"><a href="#t2">Miriam Allen de Ford</a></li>
			<li class="tab"><a href="#t3">J.R.R. Tolkien</a></li>
			<li class="tab"><a href="#t4">Terry Pratchett</a></li>
		</ul>
	</div>
</div>
</div>
@stop