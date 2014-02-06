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

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
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

@if((Auth::check()) && (Auth::user()->access_level == 3))
<input type="hidden" name="old" id="old">
<input type="hidden" name="oldtitle" id="oldtitle">
@include('partials/modals')
@endif

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
<!-- <script type="text/javascript" src="/js/jquery-sortable-min.js"></script> -->
<script type="text/javascript" src="/js/jquery.nestable.js"></script>
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
        selector: '.ddmitem', 
        callback: function(key, options) {
           // get the id of the menu item
           var id = $(this).data('ddmitem-id');
           var mid = $(this).data('mitem-id')
           // call ajax to get menu item details;
           getDataForDDMenuItem(id, mid);
           $('#ddmenuItemModal').modal();
        },
        items: {
            "edit": {name: " Edit", icon: "edit"}
        }
    });
});

function getDataForDDMenuItem(menu_item_id, parent_item_id) {
	var theHtml = "";
	$("#ddmenu_item_id").val(menu_item_id);
	$("#dd_parent_menu_item_id").val(parent_item_id);
    $.ajax({
		type: 'GET',
		url: '/menu/ddmenujson',
		data: {id: menu_item_id},
		dataType: 'json',
		success: function(_data) {
			var json = $.parseJSON(JSON.stringify(_data));
			$("#ddmenu_text").val(json.menu_text);
			$("#ddmenu_active").val(json.active);
			$("#ddmenu_page_id").val(json.page_id);
			$("#ddmenu_url").val(json.url);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}


$(function(){
    $.contextMenu({
        selector: '.mitem', 
        callback: function(key, options) {
           // get the id of the menu item
           var id = $(this).data('mitem-id');
           // call ajax to get menu item details;
           getDataForMenuItem(id);
           $('#menuItemModal').modal();
        },
        items: {
            "edit": {name: " Edit", icon: "edit"}
        }
    });
});

function getDataForMenuItem(menu_item_id) {
	var theHtml = "";
	$("#menu_item_id").val(menu_item_id);
    $.ajax({
		type: 'GET',
		url: '/menu/menujson',
		data: {id: menu_item_id},
		dataType: 'json',
		success: function(_data) {
			var json = $.parseJSON(JSON.stringify(_data));
			$("#menu_text").val(json.menu_text);
			$("#menu_active").val(json.active);
			$("#menu_page_id").val(json.page_id);
			$("#menu_url").val(json.url);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
    
}

function addMenuItem(){
	$("#menu_text").val('');
	$("#menu_active").val(0);
	$("#menu_page_id").val(0);
	$("#menu_url").val('');
	$("#menu_item_id").val(0);
	$('#menuItemModal').modal();
}

function addDDMenuItem(x){
	$("#ddmenu_text").val('');
	$("#ddmenu_active").val(0);
	$("#ddmenu_page_id").val(0);
	$("#ddmenu_url").val('');
	$("#ddmenu_item_id").val(0);
	$('#ddmenuItemModal').modal();
	$("#dd_parent_menu_item_id").val(x);
}

function deleteMenuItem() {
	var r=confirm("Are you sure you want to delete this item?");
	if (r==true)
	{
		$("#deleteid").val($("#menu_item_id").val())
		$("#deletemenuitemform").submit();
	}
}

function deleteDDMenuItem(){
	var r=confirm("Are you sure you want to delete this item?");
	if (r==true)
	{
		$("#dddeleteid").val($("#ddmenu_item_id").val());
		$("#deleteddmenuitemform").submit();
	}
}

$(document).ready(function () {
	//$("ul.menusort").sortable();
	
	var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    
    $('#nestable').nestable({group: 1}).on('change', updateOutput);
    
    updateOutput($('#nestable').data('output', $('#nestable-output')));
	
	$("#menuItemForm").validate({
		rules: {
			verify_email: {
				required: true,
				equalTo: "#email",
				email: true
			}
		},
		highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-inline',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
	$("#ddmenuItemForm").validate({
		rules: {
			verify_email: {
				required: true,
				equalTo: "#email",
				email: true
			}
		},
		highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-inline',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
});
</script>
@endif
@endif
@yield('bottom-js')
</body>
</html>