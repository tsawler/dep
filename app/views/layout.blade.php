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
@yield('meta')

<link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/header-1.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/lemmon-slider.css" type="text/css" media="screen" />
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

<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png" />
<link rel="shortcut icon" href="favicon.ico" />

<!--[if gt IE 8]><!-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/assets/js/jquery-1.9.1.min.js"><\/script>')</script>
<!--<![endif]-->
<!--[if lte IE 8]>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<![endif]-->
<script src="/assets/js/modernizr.js"></script>
@yield('js')
</head>
<body class="index">

@include('partials/preheader')
@include('partials/header')

<!-- begin #page - the container for everything but header -->
<div id="page">

	@yield('hero-unit')
	
	@include('partials/messages')

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

<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/lemmon-slider.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="/assets/js/custom.js"></script>
@include('partials/layout_javascript')
@yield('bottom-js')
</body>
</html>