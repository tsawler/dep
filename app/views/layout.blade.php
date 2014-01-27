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
<link rel="stylesheet" href="/css/datepicker.css" type="text/css" media="screen">
<style>
.outlined{
	outline: 1px dotted red;
}
</style>
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
	
	<div class="container clearfix" id="main-content" >
	@yield('content')
	
	</div>
	<!--close .container role="main-content" --> 
	<!--begin footer -->
	<footer id="footer" class="clearfix">
		<div class="container"><!--footer container-->

			<div class="row-fluid">
				<div class="span4">
					<section>
						<h4>Contact Us</h4>
						<p>The Dog Eared Press<br>
							PO Box 1234<br>
							Fredericton NB Canada<br>
							E3B 1B1<br>
							<strong>phone:</strong> <a href="tel:5064742804" class="tele">506.474.2804</a><br>
							<strong>email:</strong> <a href="mailto:info@dogearedpress.ca">info@dogearedpress.ca</a> </p>
					</section>
					<!--close section-->
					
				</div>
				<!-- close .span4 --> 
				
				<!--section containing newsletter signup and recent images-->
				<div class="span4">
					<section>
						<h4>Conferences &amp; Shows</h4>
						<p>We'll be coming to a show near you soon!
						Watch this section for conference &amp; show related news.
						</p>
					</section>
					<section>
						<h4>Follow Us</h4>
						<ul class="social">
							<li><a class="socicon rss" href="/blog.rss" title="RSS"></a></li>
							<li><a class="socicon facebook" href="#" title="Facebook"></a></li>
							<li><a class="socicon twitterbird" href="#" title="Twitter"></a></li>
						</ul>
					</section>	
					
					<!--close section--> 
				</div>
				<!-- close .span4 --> 
				
				<!--section containing blog posts-->
				<div class="span4">
					<section>
						<h4>Stay Updated</h4>
						<p>Sign up for our newsletter. We won't share your email address.</p>
						<form action="#" method="post">
							<div class="input-append row-fluid">
								<input type="email" placeholder="Email Address" class="span6" name="email" />
								<button class="btn btn-primary">Sign Up</button>
							</div>
							<!--close input-append-->
						</form>
					</section>
					<!--close section-->

				</div>
				<!-- close .span4 --> 
			</div>
			<!-- close .row-fluid--> 
		</div>
		<!-- close footer .container--> 
		
		<!--change this to your stuff-->
		<section class="footerCredits">
			<div class="container">
				<ul class="clearfix">
					<li>Copyright &copy; <?php echo date("Y");?> Dog Eared Press</li>
					<li><a href="#">Site Map</a></li>
					<li><a href="#">Privacy</a></li>
				</ul>
			</div>
			<!--footerCredits container--> 
		</section>
		<!--close section--> 
	</footer>
	<!--/.footer--> 
	
	<span class="backToTop"><a href="#top">back to top</a></span> </div>
<!-- close #page--> 

<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/lemmon-slider.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="/assets/js/custom.js"></script>
@if(Auth::check())
@if(Auth::user()->access_level == 3)
<script type="text/javascript" src="/ck/ckeditor.js"></script>
<script type="text/javascript" src="/ck/adapters/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
<script>
CKEDITOR.disableAutoInline = true;


function showResponse(responseText, statusText, xhr, $form)  {
	$("#editmsg").removeClass("hidden");
}

var editor;

function makePageEditable(item){
	
	if ($('#editablecontent').length != 0) {
		$("#postdate").addClass("hidden");
		$("#datetimepicker").removeClass("hidden");
		$(item).attr("onclick","turnOffEditing(this)");
		$(item).html("Turn off editing");
		$("#savebar").removeClass("hidden");
		$("#savetitlebar").removeClass("hidden");
    	$("#editablecontent").attr("contenteditable","true");
    	$("#editablecontenttitle").attr("contenteditable","true");
    	$("#editablecontent").addClass("outlined");
    	$("#editablecontenttitle").addClass("outlined");
    	$("#old").val($("#editablecontent").html());
    	$("#oldtitle").val($("#editablecontenttitle").html());
    	$("#approved").removeClass("hidden");
    	
    	var editoroptions = { 
    		toolbar: 'MiniToolbar', 
    		filebrowserImageBrowseUrl: "/filemgmt/browse.php?type=images",
    		allowedContent: true
    		}
    	var myeditor = CKEDITOR.inline( document.getElementById( 'editablecontent' ),editoroptions);
    	
    	CKEDITOR.on( 'instanceLoaded', function(event) {
				editor = event.editor;
		});
		
	} else {
		alert("No editable content on this page!");
	}
}

function saveChanges(){
	var changed = editor.checkDirty();
    if (changed == true){
        // get the changed data;
        var data = editor.getData();
        // save the changed data
        $("#thedata").val(data);
        var options = { target: '#theeditmsg', success: showResponse };
        $("#savedata").unbind('submit').ajaxSubmit(options);
        $("#old").val('');
        return false;
     }
}

function saveTitleChanges(){
    // get the changed data;
    var data = $('#editablecontenttitle').html();
    $("#thetitledata").val(data);
    var options = { target: '#theeditmsg', success: showResponse };
    $("#savetitledata").unbind('submit').ajaxSubmit(options);
    $("#oldtitle").val('');
    return false;
}

function turnOffEditing(item) {
	for (name in CKEDITOR.instances) {
    	CKEDITOR.instances[name].destroy()
	}
	$("#postdate").removeClass("hidden");
	$("#approved").addClass("hidden");
	$("#datetimepicker").addClass("hidden");
	$(".menu-item").attr("onclick","makePageEditable(this)");
	$(".menu-item").html("Edit content");
	$("#editablecontent").attr("contenteditable","false");
	$("#editabletitlecontent").attr("contenteditable","false");
	$("#editablecontenttitle").removeClass("outlined");
	$("#editablecontent").removeClass("outlined");
	$("#savetitlebar").addClass("hidden");
	$("#savebar").addClass("hidden");
	if ($('#oldtitle').val() != ''){
		$("#editablecontenttitle").html($("#oldtitle").val());
	}
	if ($('#old').val() != ''){
		$("#editablecontent").html($("#old").val());
	}
}

function turnOffTitleEditing() {
	$("#editabletitlecontent").attr("contenteditable","false");
	$("#editablecontenttitle").removeClass("outlined");
	$("#savetitlebar").addClass("hidden");
	if ($('#oldtitle').val() != ''){
		$("#editablecontenttitle").html($("#oldtitle").val());
	}
}

function turnOffContentEditing() {
	$("#editablecontent").attr("contenteditable","false");
	$("#editablecontent").removeClass("outlined");
	$("#savebar").addClass("hidden");
	if ($('#old').val() != ''){
		$("#editablecontent").html($("#oldt").val());
	}
}
function stub() {
	alert("This functionality is not yet implemented!");
}
</script>
@endif
@endif
@yield('bottom-js')
<input type="hidden" name="old" id="old">
<input type="hidden" name="oldtitle" id="oldtitle">
</body>
</html>