@extends('layout')

@section('content')	

<div class="container">

	<div id="editmsg" class='alert alert-success hidden'>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span id="theeditmsg">&nbsp;</span>
	</div>
	
	<h3 class="short_headline" style="text-transform: none;">
		<span>Create New Page</span>
	</h3>
	
	@if(count($errors) > 0)
	<div class="alert alert-error">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
	@endif
	
	{{ Form::open(array('url' => '',  'class' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}

		
		<div id="editmsg" class='alert alert-success hidden'>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span id="theeditmsg">&nbsp;</span>
		</div>
		
		<div class="control-group">
		{{ Form::label('page_title', 'Page Title', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-font"></i></span>
	    {{ Form::text('page_title', null, array('class' => 'required', 'autofocus'=>'autofocus')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('active', 'Page Status', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-check-sign"></i></span>
	    {{ Form::select('active', array(
	    	'0' => 'Inactive',
	    	'1' => 'Published'
	    	)); 
		}}
	    </div>
	    </div>
	    </div>
		
	    
	    <div class="control-group">
		{{ Form::label('page_content', 'Page Content', array('class' => 'control-label')); }}
		<div class="controls">
	    {{ Form::textarea('page_content', null ); }}
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('meta_keywords', 'Meta-keywords', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-code"></i></span>
	    {{ Form::text('meta_keywords', null, array('class' => 'required')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('meta_description', 'Meta-description', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-code"></i></span>
	    {{ Form::text('meta_description', null, array('class' => 'required input-xxlarge', 'size' => '50')); }}
	    </div>
	    </div>
	    </div>
	    <hr>
	    <div class="control-group">
	    <div class="controls">
	    <input type="submit" class="btn btn-primary" value="Save Page">
	    </div>
	    </div>

	{{ Form::close() }}
	</div>

@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
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
