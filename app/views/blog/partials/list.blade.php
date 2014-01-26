<div class="span9 blog-summary primary-column"> 

    @if (!$posts->isEmpty())

    	@foreach ($posts as $post)

    		<article class="entry-post">
    		    
    		    <header class="entry-header">
					<h3 class="entry-title">
						<a href="{{ $post->getUrl() }}" title="{{ $post->title }}">{{ $post->title }}</a>
					</h3>
					<div class="byline"><i class="icon-time"></i> 
						{{ date(Config::get('laravel-blog::published_date_format'), strtotime($post->published_date)) }}
					</div>
				</header>

				<div class="entry-content">
					@if (!empty($post->image))
					<figure>
						<a href="{{ $post->getUrl() }}" class="hover">
							<img src="{{ $post->getThumbnailImage() }}" alt=""><span class="plus"></span>
						</a>
					</figure>
					@endif
					<p>{{ $post->summary }}</p>
						<p class="more right"><a class="btn btn-primary" href="{{ $post->getUrl() }}">Read More &rarr;</a> 
				</div>
				<!-- close entry-content -->

				<footer class="entry-footer"> 
					<span class="blog date"> 
						<span class="month">{{ date('M', strtotime($post->published_date)) }}</span> 
						<span class="day">{{ date('d', strtotime($post->published_date)) }}</span> 
						<span class="year">{{ date('Y', strtotime($post->published_date)) }}</span> 
					</span> 
				<!--close date--> 
				</footer>
				<!--end entry-footer--> 


    		</article>

    	@endforeach

    @else

    	<p class="blog--empty">
    		{{ trans('laravel-blog::messages.list.no_posts') }}
    	</p>

    @endif
    
</div>