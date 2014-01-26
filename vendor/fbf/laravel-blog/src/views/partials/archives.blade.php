@if (Config::get('laravel-blog::show_archives_on_view') and !empty($archives))
	<aside class="widget clearfix">
		<h5 class="short_headline"><span>Archives</span></h5>
		<ul class="navigation">
		@foreach ($archives as $year => $months)
		<li>{{ $year }}
			<ul class="navigation">
				@foreach ($months as $monthNumber => $month)
				<li>
					<a href="/{{ Config::get('laravel-blog::uri') }}/{{ $year }}/{{ $monthNumber }}">{{ $month['monthname'] }} ({{ $month['count'] }})</a>
				</li>
				@endforeach
			</ul>
		</li>
		@endforeach
	</ul>
	</aside>
@endif