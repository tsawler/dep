<!-- begin accesibility skip to nav skip content -->
<ul class="visuallyhidden" id="top">
	<li><a href="#nav" title="Skip to navigation" accesskey="n">Skip to navigation</a></li>
	<li><a href="#page" title="Skip to content" accesskey="c">Skip to content</a></li>
</ul>
<!-- end /.visuallyhidden accesibility--> 

<!-- mobile navigation trigger-->
<h5 class="mobile_nav"><a href="javascript:void(0)">&nbsp;<span></span></a></h5>
<!--end mobile navigation trigger-->

<section class="container preheader"> 
	<!--this is the login for the user-->
	 @if(!Auth::check())
       <nav class="user clearfix"> <a href="/users/login"><i class="icon-user"></i> Login</a> </nav> 
       <nav class="user clearfix"> <a href="/users/register"><i class="icon-pencil"></i> Register</a> </nav>   
     @else
       <nav class="user clearfix"> <a href="/users/logout"><i class="icon-remove-sign"></i> Logout</a> </nav>
       <nav class="user clearfix"> <a href="/users/dashboard"><i class="icon-dashboard"></i> Dashboard</a> </nav>
     @endif
	
	<!--close user nav-->
	
	<div class="search-wrapper">
		{{ Form::open(array('url' => 'search', 'class' => 'search', 'method' => 'post')) }}
			<div id="search-trigger">Search:</div>
			{{ Form::text('searchterm', null, array('id' => 'search-box', 'placeholder' => 'search + enter')); }}
		{{ Form::close() }}
	</div>
	<div class="phone"><a href="tel:15064742804" class="tele">+1.506.474.2804</a></div>
	<ul class="social">
		<li><a class="socicon small rss" href="/blog.rss" data-placement="bottom" title="Subscribe to our RSS feed"></a></li>
		<li><a class="socicon small facebook" href="#" data-placement="bottom" title="Follow us on Facebook"></a></li>
		<li><a class="socicon small twitterbird" href="https://twitter.com/dogearedpress" data-placement="bottom" title="Follow us on Twitter"></a></li>
	</ul>
</section>