@extends('layout')



@section('hero-unit')
<div class="hero-unit">
	<div class="container">
		<h2>The Dog-Eared Blog</h2>
	</div>
	<!--close container--> 
</div>
<!--close hero-unit-->
@endsection

@section('content')

	<div class="row-fluid sidebar-right"> 

	@include('blog.partials.list')
	
	<section class="span3 sidebar secondary-column" id="secondary-nav">
	
	<aside class="widget">
		<h5 class="short_headline"><span>Search Blog Posts</span></h5>
		
		{{ Form::open(array('url' => '/searchblog', 'class' => 'searchform', 'method' => 'post')) }}
			{{ Form::text('searchterm', null, array('class' => ' span10', 'id' => 'search-box', 'placeholder' => 'type and hit enter')); }}
		{{ Form::close() }}
	</aside>
	
	@include('blog.partials.archives')
	
	</section>
	</div>
@stop