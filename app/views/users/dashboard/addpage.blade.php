@extends('layout')

@section('browser-title')
Add Page: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
		
		<h3 class="short_headline" style="text-transform: none;"><span>Add Page</span></h3>
		
		
		{{ Form::open(array('role' => 'form', 'url' => '/admin/savepage',  'class' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
		
		<div class="control-group">
		{{ Form::label('page_name', 'Page title', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon icon-font"></i></span>
		{{ Form::text('page_name', null, array('class' => 'required form-control',
			'placeholder' => 'Page title',
			'autofocus'=>'autofocus')); }}
				</div>
		    </div>
		</div>
		
		<div class="control-group">
		{{ Form::label('active', 'Page active?', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-prepend"> <span class="add-on">?</span>
					{{ Form::select('active', array(
							'1' => 'Yes',
							'0' => 'No'),
							1,
							array('class' => 'form-control')) }}
				</div>
		    </div>
		</div>
	    
	    <div class="control-group">
		{{ Form::label('page_content', 'Page Content', array('class' => 'control-label')); }}
		<div class="controls" style='max-width: 650px;'>
	    {{ Form::textarea('page_content', null, array('style' => 'max-width: 400px;') ); }}
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('meta_keywords', 'Meta Keywords', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-prepend"> <span class="add-on"><i class="icon icon-code"></i></span>
					{{ Form::text('meta_keywords', null, array('class' => 'required form-control input-xxlarge',
		    											'placeholder' => 'keyword, keyword')); }}
				</div>
		    </div>
		</div>
		
	    <div class="control-group">
		{{ Form::label('meta_description', 'Meta Description', array('class' => 'control-label')); }}
			<div class="controls">
				<div class="input-prepend"> <span class="add-on"><i class="icon icon-code"></i></span>
					{{ Form::text('meta_description', null, array('class' => 'required form-control input-xxlarge',
		    											'placeholder' => 'Description')); }}
				</div>
		    </div>
		</div>
		
		<hr>
		
		<div class="control-group">
		<div class="controls">
		{{ Form::submit('Save', array('class' => 'btn btn-primary')); }}
		</div>
		</div>


	{{ Form::close() }}
	
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>
@stop

@section('bottom-js')
<script>
function confirmDelete(x){
	bootbox.confirm("Are you sure you want to delete this page?", function(result) {
		if (result) {
			window.location.href = '/admin/deletepage/'+x;
		}
	});
}
$(document).ready(function () {	
	$("#bookform").validate({
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
	
	CKEDITOR.replace( 'page_content',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
});
</script>
@stop