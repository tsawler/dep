<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" dir="ltr"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en" dir="ltr"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" dir="ltr"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" dir="ltr"><!--<![endif]-->

<head>
<title>
@yield('browser-title')
</title>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="google-site-verification" content="Rh8eceAC4Iqu2nl3ere_7CXhwumQ6wXJwBL8ztUdcFs" />
@yield('meta')

<link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/header-1.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/lemmon-slider.css" type="text/css" media="screen" />
<link href="/css/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/assets/css/custom.css" type="text/css" media="screen" />
@if(Auth::check())
@if(Auth::user()->access_level == 3)
@if (Auth::user()->roles->contains(3))
<link rel="stylesheet" href="/js/contextmenu/jquery.contextMenu.css" type="text/css" media="screen">
<link rel="stylesheet" href="/css/datepicker.css" type="text/css" media="screen">
@endif
@endif
@endif
@yield('css')

<link rel="shortcut icon" href="favicon.ico" />

<!--[if gt IE 8]><!-->
<script asynyc src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/assets/js/jquery-1.9.1.min.js"><\/script>')</script>
<!--<![endif]-->
<!--[if lte IE 8]>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<![endif]-->
<script async src="/assets/js/modernizr.js"></script>
@yield('js')
</head>
<body class="index">

@include('partials/preheader')
@include('partials/header')

<!-- begin #page - the container for everything but header -->
<div id="page">

	@yield('hero-unit')

	<div class="container clearfix" id="main-content"> 
	@yield('content')
	</div>
	
	@include('partials/bottom_of_page')
</div>
<!-- close #page--> 

@if((Auth::check()) 
	&& (Auth::user()->access_level == 3))
<input type="hidden" name="old" id="old">
<input type="hidden" name="oldtitle" id="oldtitle">
@include('partials/modals')
@endif

<script async src="/assets/js/bootstrap.min.js"></script>
<script async src="/assets/js/lemmon-slider.min.js"></script>
<script async src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script async src="/assets/js/custom.js"></script>
@include('partials/layout_javascript')
<script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/3.3.0/bootbox.min.js"></script>
<script type="text/javascript" src="/js/jquery.pnotify.min.js"></script>
@yield('bottom-js')
@include('partials/messages')
</body>
</html>