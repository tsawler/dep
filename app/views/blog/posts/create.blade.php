@extends('layout')

@section('browser-title')
	Blog: Create Post
@endsection

@section('content')
	<div class="row-fluid sidebar-right"> 
		<div class="span9 blog-summary primary-column"> 
					
			@include('blog.partials.createdetails')
	
		</div>
		<section class="span3 sidebar secondary-column" id="secondary-nav">

			<aside class="widget">
				<h5 class="short_headline"><span>Search Blog Posts</span></h5>
				{{ Form::open(array('url' => '/searchblog', 'class' => 'searchform', 'method' => 'post')) }}
					{{ Form::text('searchterm', null, array('class' => ' span10', 'id' => 'search-box', 'placeholder' => 'type and hit enter')); }}
				{{ Form::close() }}
			</aside>
			
		</section>
	</div>
@stop