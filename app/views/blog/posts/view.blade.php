@extends('layout')

@section('browser-title')
	Blog: {{ Config::get('laravel-blog::index_page_title') }}
@endsection

@section('meta_description')
	{{ $post->meta_description }}
@endsection

@section('meta_keywords')
	{{ $post->meta_keywords }}
@endsection

@section('hero-unit')
<div class="hero-unit">
	<div class="container">
		<h2>Blog</h2>
	</div>
	<!--close container--> 
</div>
<!--close hero-unit-->
@endsection

@section('content')
	<div class="row-fluid sidebar-right"> 
		<div class="span9 blog-summary primary-column"> 
					
			@include('blog.partials.details')
	
		</div>
		<section class="span3 sidebar secondary-column" id="secondary-nav">

			<aside class="widget">
				<h5 class="short_headline"><span>Search Blog Posts</span></h5>
				<form class="searchform" method="get">
					<input type="search" class="span12" value="type and hit enter" onFocus="this.value=''" onBlur="this.value='type and hit enter'" />
				</form>
			</aside>
			@include('blog.partials.archives')
			
		</section>
	</div>
@stop