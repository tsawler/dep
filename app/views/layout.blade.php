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
<link rel="stylesheet" href="/js/contextmenu/jquery.contextMenu.css" type="text/css" media="screen">
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
	
	@if((Session::has('message')) || (Session::has('error') || (count($errors) > 0)))
		<div class="container clearfix">
		<div class="row-fluid reverse-order"> 
		<div class="span12">
		@if(Session::has('message'))
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('message') }}
			</div>
		@endif
		@if (Session::has('error'))
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('error') }}
			</div>
		@endif
		@if (Session::has('status'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('status') }}
			</div>
		@endif
		@if(count($errors) > 0)
		<div class="alert alert-error">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
		@endif
		</div>
		</div>
		</div>
	@endif

	<div class="container clearfix" id="main-content"> 
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
						<p>The Dog-Eared Press<br>
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
					<li>Copyright &copy; <?php echo date("Y");?> Dog-Eared Press</li>
					<li><a href="#">Site Map</a></li>
					<li><a href="#">Privacy</a></li>
				</ul>
			</div>
			<!--footerCredits container--> 
		</section>
		<!--close section--> 
	</footer>
	<!--/.footer--> 
	
	<span class="backToTop"><a href="#top">back to top</a></span> 
</div>
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/js/contextmenu/jquery.contextMenu.js"></script>
<script type="text/javascript" src="/js/contextmenu/jquery.ui.position.js"></script>
<script>
CKEDITOR.disableAutoInline = true;


function showResponse(responseText, statusText, xhr, $form)  {
	$("#editmsg").removeClass("hidden");
}

var editor;

function makePageEditable(item){
	
	if ($('#editablecontent').length != 0) {
		$("#postdate").addClass("hidden");
		$(".admin-hidden").addClass('admin-display').removeClass('admin-hidden');
		$(item).attr("onclick","turnOffEditing(this)");
		$(item).html("Turn off editing");
    	$("#editablecontent").attr("contenteditable","true");
    	$("#editablecontenttitle").attr("contenteditable","true");
    	$("#editablecontent").addClass("outlined");
    	$("#editablecontenttitle").addClass("outlined");
    	$("#old").val($("#editablecontent").html());
    	$("#oldtitle").val($("#editablecontenttitle").html());
    	
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

function saveEditedPage(){
	// get the changed data;
    var data = $('#editablecontenttitle').html();
    $("#thetitledata").val(data);
    
    // get the changed data;
    var pagedata = editor.getData();
    // save the changed data
    $("#thedata").val(pagedata);
    
    var options = { target: '#theeditmsg', success: showResponse };
    $("#savetitledata").unbind('submit').ajaxSubmit(options);
    $("#oldtitle").val('');
    $("#old").val('');
    return false;
}

function turnOffEditing(item) {
	for (name in CKEDITOR.instances) {
    	CKEDITOR.instances[name].destroy()
	}
	$(".admin-display").addClass('admin-hidden').removeClass('admin-display');
	$("#postdate").removeClass("hidden");
	$(".menu-item").attr("onclick","makePageEditable(this)");
	$(".menu-item").html("Edit content");
	$("#editablecontent").attr("contenteditable","false");
	$("#editablecontenttitle").attr("contenteditable","false");
	$("#editablecontenttitle").removeClass("outlined");
	$("#editablecontent").removeClass("outlined");
	if ($('#oldtitle').val() != ''){
		$("#editablecontenttitle").html($("#oldtitle").val());
	}
	if ($('#old').val() != ''){
		$("#editablecontent").html($("#old").val());
	}
}

function stub() {
	alert("This functionality is not yet implemented!");
}

$(function(){
    $.contextMenu({
        selector: '.mitem', 
        callback: function(key, options) {
           // get the id of the menu item
           var id = $(this).data('mitem-id');
           // call ajax to get menu item details;
           
            $('#menuItemModal').modal();
        },
        items: {
            "edit": {name: " Edit", icon: "edit"}
        }
    });
    
    $('.context-menu-one').on('click', function(e){
        console.log('clicked', this);
    })
});

function getDataForMenuItem(menu_item_id) {
	var theHtml = "";
	$("#action").val(0);
    $("#notelineid").val(line_id);
    $("#user_note_id").val(note_id);
    $.ajax({
		type: 'GET',
		url: '/page/getusernote',
		data: {id: line_id},
		dataType: 'html',
		success: function(_data) {
			theHtml = _data;
			$("#note").val(_data);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}
</script>
@endif
@endif
@yield('bottom-js')
@if((Auth::check()) && (Auth::user()->access_level == 3))
<input type="hidden" name="old" id="old">
<input type="hidden" name="oldtitle" id="oldtitle">

<div class="modal hide fade" id="menuItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Menu Item</h4>
			</div>
			<div class="modal-body" id="modalbody">
			
				<form id="menuItemForm" class="form-horizontal" name="menuItemForm" method="post" action="menu/saveMenuItem">
					<div class="control-group">
						<label for="menu_text" class="control-label">Menu text</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">A</span>
								<input type="text" name="menu_text" id="menu_text" class="required" autofocus>
							</div>
						</div>
				    </div>
				    
				    <div class="control-group">
						<label for="active" class="control-label">Active?</label>
						<div class="controls">
							<div class="input-prepend"> 
								<span class="add-on"><i class="icon-check-sign"></i></span>
								<select name="active" id="active">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
				    </div>
				    
				    <div class="control-group">
						<label for="link" class="control-label">Links to</label>
						<div class="controls">
							<div class="input-prepend"> 
								<span class="add-on"><i class="icon-link"></i></span>
								<select name="link" id="link">
									<option value="0">Does not link to page</option>
									@foreach(Page::all() as $item)
									<option value="{{ $item->slug }}">{{ $item->page_title }}</option>
									@endforeach
								</select>
							</div>
						</div>
				    </div>
				    
				    <div class="control-group">
						<label for="url" class="control-label">URL</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-external-link-sign"></i></span>
								<input type="text" name="url" id="url" class="" autofocus>
							</div>
						</div>
				    </div>
				    
				</form>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>
@endif
</body>
</html>