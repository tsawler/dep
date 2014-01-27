<article class="entry-post">    
	
	{{ Form::open(array('url' => '',  'class' => 'form', 'name' => 'bookform', 'id' => 'bookform')) }}
	<header class="entry-header">
		
		<div id="editmsg" class='alert alert-success hidden'>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span id="theeditmsg">&nbsp;</span>
		</div>
		
		<div class="control-group">
		{{ Form::label('post_title', 'Title', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-font"></i></span>
	    {{ Form::text('post_title', null, array('class' => 'required', 'autofocus'=>'autofocus')); }}
	    </div>
	    </div>
	    </div>

		<div class="control-group">
		{{ Form::label('post_date', 'Date', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class=" icon-calendar"></i></span>
	    {{ Form::text('post_date', date("Y-m-d"), array('class' => 'required dateISO')); }}
	    </div>
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('status', 'Status', array('class' => 'control-label')); }}
		<div class="controls">
		<div class="input-prepend"> <span class="add-on"><i class="icon-check-sign"></i></span>
	    {{ Form::select('status', array(
	    	'DRAFT' => 'Draft',
	    	'APPROVED' => 'Approved'
	    	)); 
		}}
	    </div>
	    </div>
	    </div>
		
	</header>

	<div class="entry-content">
		
		<div class="control-group">
		{{ Form::label('post_summary', 'Post Summary', array('class' => 'control-label')); }}
		<div class="controls">
	    {{ Form::textarea('post_summary', null ); }}
	    </div>
	    </div>
	    
	    <div class="control-group">
		{{ Form::label('post_content', 'Full Post', array('class' => 'control-label')); }}
		<div class="controls">
	    {{ Form::textarea('post_content', null ); }}
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
	    
	    <div class="control-group">
	    <div class="controls">
	    <input type="submit" class="btn btn-primary" value="Save Post">
	    </div>
	    </div>
	</div>
	
	
	<footer class="entry-footer"> 
		<span class="blog date"> 
			<span class="month">{{ date("M") }}</span> 
			<span class="day">{{ date("d") }}</span> 
			<span class="year">{{ date("Y") }}</span> 
		</span> 
	<!--close date--> 
	</footer>
	
	{{ Form::close() }}
	
</article>

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
	
	
	$("#post_date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
	CKEDITOR.replace( 'post_content',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
	CKEDITOR.replace( 'post_summary',
	{
		toolbar : 'MyToolbar',
		forcePasteAsPlainText: true,
		filebrowserBrowseUrl : '/filemgmt/browse.php?type=files',
		filebrowserImageBrowseUrl : '/filemgmt/browse.php?type=images',
		filebrowserFlashBrowseUrl : '/filemgmt/browse.php?type=flash',
		enterMode : '1'
	});
});

function saveDate(){
    var options = { target: '#theeditmsg', success: showResponse };
    $("#dateform").unbind('submit').ajaxSubmit(options);
    return false;
}
</script>
@stop
