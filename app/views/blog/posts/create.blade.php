@extends('layout')

@section('browser-title')
	Blog: {{ Config::get('laravel-blog::index_page_title') }}
@endsection

@section('meta_description')
	
@endsection

@section('meta_keywords')
	
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
					{{ Form::text('searchterm', null, array('id' => 'search-box', 'placeholder' => 'type and hit enter')); }}
				{{ Form::close() }}
			</aside>
			@include('blog.partials.archives')
			
		</section>
	</div>
@stop