<article class="entry-post">
    		    
	<header class="entry-header">
		
		@if(Auth::check())
		@if(Auth::user()->access_level == 3)
			<div id="editmsg" class='alert alert-success hidden'>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span id="theeditmsg">&nbsp;</span>
			</div>
			<form action="/saveeditedpost" method="post" id="savetitledata" name="savetitledata">
				<div class="hidden" id="savebar" style='margin-bottom: 5px;'>
					<div class='pull-right'>
						<a href='#!' style='text-decoration: none;'><i class="icon-remove-sign" onclick="turnOffEditing()"></i></a>&nbsp;
						<a href='#!' onclick='saveChanges()' style='text-decoration: none;'><i class="icon-save" onclick="savePostChanges()"></i></a>
					</div>
				</div>
				<div style="clear: both; margin-bottom: 5px;"></div>
				<div id="approved" class="hidden pull-right">
				<select name="status" id="status">
					<option value="DRAFT"
						@if($post->status == 'DRAFT')
							selected
						@endif
						>Draft</option>
					<option value="APPROVED"
						@if($post->status == 'APPROVED')
							selected
						@endif
						>Approved</option>
				</select>

				</div>
				<div style="clear: both; margin-bottom: 5px;"></div>
		
					<h3 class="entry-title">
						<article id="editablecontenttitle" style='width: 100%'>
							{{ $post->title }}
							</article>
					</h3>
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<input type="hidden" name="thetitledata" id="thetitledata">

		@endif
		@endif
		
		@if(Auth::check())
		@if(Auth::user()->access_level == 1)
			<h3 class="entry-title">{{ $post->title }}</h3>
		@endif
		@endif
		
		@if(!Auth::check())
			<h3 class="entry-title">{{ $post->title }}</h3>
		@endif
			
		@if(Auth::check())
		@if(Auth::user()->access_level == 3)
			<div class="byline" id="postdate"><i class="icon-time"></i>
				{{ date(Config::get('laravel-blog::published_date_format'), strtotime($post->published_date)) }}
			</div>
			<div class='hidden input-append date' id='datetimepicker'>
				<input  type='text' id="post_date" name='post_date' value="{{ date('Y-m-d', strtotime($post->published_date)) }}">
			</div>
		@else
			<div class="byline"><i class="icon-time"></i>
				{{ date(Config::get('laravel-blog::published_date_format'), strtotime($post->published_date)) }}
			</div>
		@endif
		@endif
		
		@if(!Auth::check())
			<div class="byline"><i class="icon-time"></i>
			{{ date(Config::get('laravel-blog::published_date_format'), strtotime($post->published_date)) }}
			</div>
		@endif
	</header>

	<div class="entry-content">
		@if (!empty($post->image))
		<figure>
			<a href="{{ $post->getUrl() }}" class="hover">
				<img src="{{ $post->getThumbnailImage() }}" alt=""><span class="plus"></span>
				</a>
		</figure>
		@endif
		
		@if(Auth::check())
		@if(Auth::user()->access_level ==3)
			<article id="editablecontent" itemprop="description" style='width: 100%'>
				{{ $post->content }}
			</article>
			<input type="hidden" name="thedata" id="thedata">
		@endif
		@endif
		
		@if(Auth::check())
		@if(Auth::user()->access_level == 1)
			{{ $post->content }}
		@endif
		@endif
		
		@if(!Auth::check())
			{{ $post->content }}
		@endif
		
		@if(Auth::check())
		@if(Auth::user()->access_level == 1)
			</form>
		@endif
		@endif
		
		@if (Config::get('laravel-blog::show_share_partial_on_view'))
			@include('blog.partials.share')
		@endif
		<br><br>
		
		<a href="{{ action('Fbf\LaravelBlog\PostsController@index') }}">
        			{{ trans('laravel-blog::messages.details.back_link_text') }}
        </a>
	</div>

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

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#post_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
});
function savePostChanges(){
    // get the changed content data;
    var data = editor.getData();
    // save the changed data
    $("#thedata").val(data);
    $("#old").val('');
    
    // get the changed data;
    var titledata = $('#editablecontenttitle').html();
    $("#thetitledata").val(titledata);
    var options = { target: '#theeditmsg', success: showResponse };
    $("#savetitledata").unbind('submit').ajaxSubmit(options);
    $("#oldtitle").val('');
    return false;
}
</script>
@stop
