@if(Auth::check())
@if((Auth::check()) 
	&& (Auth::user()->access_level == 3))
<script type="text/javascript" src="/ck/ckeditor.js"></script>
<script type="text/javascript" src="/ck/adapters/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/js/contextmenu/jquery.contextMenu.js"></script>
<script type="text/javascript" src="/js/contextmenu/jquery.ui.position.js"></script>
<script type="text/javascript" src="/js/jquery.sortable.min.js"></script>
<script>
CKEDITOR.disableAutoInline = true;

function showResponse(responseText, statusText, xhr, $form)  {
	x = $("#theeditmsg").html();
	$.pnotify({
	    icon: false,
	    type: 'success',
	    text: x
	});
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
		bootbox.alert("No editable content on this page!");
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
	bootbox.alert("This functionality is not yet implemented!");
}


// start of ddmenu

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
	getDDSortableList(parent_item_id);
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

function getDDSortableList(x){

    $.ajax({
		type: 'GET',
		url: '/menu/ddsortitems',
		data: {id: x},
		dataType: 'html',
		success: function(_data) {
			var theHtml = _data;
			$("#ddplacement").html(theHtml);
			var a = {};
			$("#ddsortable li").each(function(i, el){
	            a[$(el).data('id')] = $(el).index() + 1;
	        });
	        sorteda = JSON.stringify(a);
	        $("#ddoutput").val(sorteda);
	        
			$('#ddsortable').sortable().bind('sortupdate', function() {
				var a = {};
				$("#ddsortable li").each(function(i, el){
		            a[$(el).data('id')] = $(el).index() + 1;
		        });
		        sorteda = JSON.stringify(a);
		        $("#ddoutput").val(sorteda);
			});
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

// end of ddmenu

// start of menu

$(function(){
    $.contextMenu({
        selector: '.mitem', 
        callback: function(key, options) {
           // get the id of the menu item
           var id = $(this).data('mitem-id');
           // call ajax to get menu item details;
           getDataForMenuItem(id);
        },
        items: {
            "edit": {name: " Edit", icon: "edit"}
        }
    });
});

function getDataForMenuItem(menu_item_id) {
	var theHtml = "";
	$("#menu_item_id").val(menu_item_id);
	getSortableList();
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
			$("#has_children").val(json.has_children);
			$('#menuItemModal').modal();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

function getSortableList(){

    $.ajax({
		type: 'GET',
		url: '/menu/sortitems',
		dataType: 'html',
		success: function(_data) {
			var theHtml = _data;
			$("#placement").html(theHtml);
			var a = {};
			$("#sortable li").each(function(i, el){
	            a[$(el).data('id')] = $(el).index() + 1;
	        });
	        sorteda = JSON.stringify(a);
	        $("#output").val(sorteda);
	        
			$('#sortable').sortable().bind('sortupdate', function() {
				var a = {};
				$("#sortable li").each(function(i, el){
		            a[$(el).data('id')] = $(el).index() + 1;
		        });
		        sorteda = JSON.stringify(a);
		        $("#output").val(sorteda);
			});
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert("Status: " + textStatus); 
			alert("Error: " + errorThrown);
		}
    });
}

// end of menu

function addMenuItem(){
	$("#menu_text").val('');
	$("#menu_active").val(0);
	$("#menu_page_id").val(0);
	$("#menu_url").val('');
	$("#menu_item_id").val(0);
	$('#menuItemModal').modal();
	$("#sortmenuitems").addClass("hidden");
	$("#placement").addClass("hidden");
}

function addDDMenuItem(x){
	$("#ddmenu_text").val('');
	$("#ddmenu_active").val(0);
	$("#ddmenu_page_id").val(0);
	$("#ddmenu_url").val('');
	$("#ddmenu_item_id").val(0);
	$("#ddsortmenuitems").addClass("hidden");
	$("#ddplacement").addClass("hidden");
	$('#ddmenuItemModal').modal();
	$("#dd_parent_menu_item_id").val(x);
}

function deleteMenuItem(){
	var r = bootbox.confirm("Are you sure you want to delete this item?");
	if (r==true)
	{
		$("#deleteid").val($("#menu_item_id").val())
		$("#deletemenuitemform").submit();
	}
}

function deleteDDMenuItem(){
	var r=bootbox.confirm("Are you sure you want to delete this item?");
	if (r==true)
	{
		$("#dddeleteid").val($("#ddmenu_item_id").val());
		$("#deleteddmenuitemform").submit();
	}
}

$(document).ready(function () {

	$('#ddmenuItemModal').on('hidden', function () {
		$("#ddplacement").html('');
  	});
  	
  	$('#menuItemModal').on('hidden', function () {
		$("#placement").html('');
  	});
	
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