<!-- begin .header-->
<header class="header  clearfix"> <img src="/assets/images/dep-logo-sm.png" class="print logo" alt="Dog-Eared Press" />
	<div class="container"> 
		<div class="mobile-menu-holder"><!--clone menu here for mobile--></div>
		<!-- begin #main_menu -->
		<nav id="main_menu">
			<ul class="primary_menu">
			
				@if((Auth::check()) && (Auth::user()->access_level == 3) && (Auth::user()->roles->contains(3)))

					@foreach((MenuItem::where('menu_id','=','1')->orderBy('sort_order')->get()) as $item)
						@if ($item->has_children == 0)
							@if ($item->active == 1)
								@if ($item->page_id == 0)
									<li>
										<a class='mitem' data-mitem-id="{{ $item->id }}" href='{{ $item->url }}'>{{ $item->menu_text }}</a>
									</li>
								@else
									<li>
										<a class='mitem' data-mitem-id="{{ $item->id }}" 
											href='/{{ $item->targetPage->slug }}'>{{ $item->menu_text }}</a>
									</li>
								@endif
							@else
								@if ($item->page_id == 0)
									<li>
										<a class='mitem' data-mitem-id="{{ $item->id }}" 
											href='{{ $item->url }}'><em class='text-warning'>{{ $item->menu_text }}</em></a>
									</li>
								@else
									<li>
										<a class='mitem' data-mitem-id="{{ $item->id }}" 
											href='/{{ $item->targetPage->slug }}'><em class='text-warning'>{{ $item->menu_text }}</em></a>
									</li>
								@endif
							@endif
						@else
							@if ($item->active == 1)
								<li class="parent">
									<a class='mitem' data-mitem-id="{{ $item->id }}" 
										href="javascript:void(0)">{{ $item->menu_text }}<i></i></a>
							@else
								<li class="parent">
									<a class='mitem' data-mitem-id="{{ $item->id }}" 
										href="javascript:void(0)"><em class='text-warning'>{{ $item->menu_text }}</em><i></i></a>
							@endif
							<ul>
							@foreach ($item->dropdownItems as $dd)
								@if ($dd->active == 1)
									@if ($dd->page_id == 0)
										<li><a class='ddmitem' data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}" 
											href="{{ $dd->url }}">{{ $dd->menu_text }}</a></li>
									@else
										<li><a class='ddmitem' data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}"
											href="/{{ $dd->targetPage->slug }}">{{ $dd->menu_text }}</a></li>
									@endif
								@else
									@if ($dd->page_id == 0)
										<li><a class="ddmitem" data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}"
											href="{{ $dd->url }}"><em class='text-warning'>{{ $dd->menu_text }}</em></a></li>
									@else
										<li><a class="ddmitem" data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}"
											href="/{{ $dd->targetPage->slug }}"><em class='text-warning'>{{ $dd->menu_text }}</em></a></li>
									@endif
								@endif
							@endforeach
							<li><a href="javascript:void(0)" onclick="addDDMenuItem({{ $item->id }})">[Add item]</a></li>
							</ul>
						@endif
					@endforeach
				@else
					@foreach((MenuItem::where('menu_id','=','1')->where('active','=','1')->orderBy('sort_order')->get()) as $item)
						@if ($item->has_children == 0)
							@if ($item->page_id == 0)
								<li><a href='{{ $item->url }}'>{{ $item->menu_text }}</a></li>
							@else
								<li><a href="/{{ $item->targetPage->slug }}">{{ $item->menu_text }}</a></li>
							@endif
						@else
							<li class="parent"><a href="javascript:void(0)">{{ $item->menu_text }}<i></i></a>
							<ul>
							@foreach ($item->dropdownItems as $dd)
								@if ($dd->active == 1)
									@if ($dd->page_id == 0)
										<li><a href="{{ $dd->url }}">{{ $dd->menu_text }}</a></li>
									@else
										<li><a href="/{{ $dd->targetPage->slug }}">{{ $dd->menu_text }}</a></li>
									@endif
								@endif
							@endforeach
							</ul>
						@endif
					@endforeach
				@endif

				
				@if(Auth::check())
				@if(Auth::user()->access_level == 3)
					@if (Auth::user()->roles->contains(3))
						<li><a href="javascript:void(0)" onclick="addMenuItem()">[Add item]</a></li>
					@endif
					
					@if ((Auth::user()->roles->contains(1)) || (Auth::user()->roles->contains(2)))
						<li class="parent"><a href="javascript:void(0)">Admin<i></i></a>
					@endif
					<ul>
						@if (Auth::user()->roles->contains(1))
							<li><a class='menu-item' href="javascript:void(0)" onclick="makePageEditable(this)">Edit content</a></li>
							<li><a class='' href="/page/create">New page</a></li>
						@endif
						@if (Auth::user()->roles->contains(2))
							<li><a class='' href="/post/create" >New blog post</a></li>
						@endif
					</ul>
				</li>
				@endif
				@endif
				
			</ul>
		</nav>
		<!-- close / #main_menu --> 
		
		<!-- begin #logo -->
		<div id="logo"> <a href="/"><img alt="" src="/assets/images/trans.gif" /><!--ie7 support--></a> </div>
		<!-- end #logo --> 
		
	</div>
	<!-- close / .container--> 
</header>
<!-- close /.header --> 