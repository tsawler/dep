<!-- begin .header-->
<header class="header  clearfix"> <img src="/assets/images/dep-logo-sm.png" class="print logo" alt="Dog Eared Press" />
	<div class="container"> 
		<div class="mobile-menu-holder"><!--clone menu here for mobile--></div>
		<!-- begin #main_menu -->
		<nav id="main_menu">
			<ul class="primary_menu">
				<li><a href="/">Home</a></li>
				<li class="parent"><a href="javascript:void(0)">About<i></i></a>
					<ul>
						<li><a href="/about">About our press</a></li>
						<li><a href="/team">Our editorial team</a></li>
						<li><a href="/our+philosophy">Our Philosophy</a></li>
						<li><a href="/sneak+peeks">Sneak peeks</a></li>
					</ul>
				</li>
				<li class="parent"><a href="javascript:void(0)">Catalogue<i></i></a>
					<ul>
						<li><a href="">Epic Fantasy</a></li>
						<li><a href="">Urban Fantasy</a></li>
						<li><a href="">Young Adult Fantasy</a></li>
					</ul>
				</li>
				<li class="parent"><a href="javascript:void(0)">Submissions<i></i></a>
					<ul>
						<li><a href="/guidelines">Our guidelines</a></li>
						<li><a href="/the+process">The process</a></li>
						<li><a href="/submit/index">Submit a manuscript</a></li>
					</ul>
				</li>
				<li><a href="/blog">Blog</a></li>
				<li><a href="/contact">Contact</a></li>
				@if(Auth::check())
				@if(Auth::user()->access_level == 3)
				<li class="parent"><a href="javascript:void(0)">Admin<i></i></a>
					<ul>
						<li><a class='menu-item' href="javascript:void(0)" onclick="makePageEditable(this)">Edit content</a></li>
						<li><a class='' href="/page/create">New page</a></li>
						<li><a class='' href="/post/create" >New blog post</a></li>
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