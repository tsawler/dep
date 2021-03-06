@extends('layout')

@section('browser-title')
Submit a Manuscript: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Submit a Manuscript</span></h3>
		
			<p>Thanks for considering the Dog-Eared Press as a home for your manuscript. We'll need to collect some
			basic information about you and your manuscript in order to proceed. Please ensure that you have <a href='/guidelines'>reviewed our 
			submission guidelines</a> first.</p>
			
			{{ Form::open(array(
				'url' => 'users/submit', 
				'files' => true, 
				'method' => 'post',
				'class' => 'form-horizontal', 
				'name' => 'bookform', 
				'id' => 'bookform')) }}
	
			
			<div class="control-group">
			{{  Form::label('pen_name', 'Pen Name', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-font"></i></span>
			{{  Form::text('pen_name', null, array('placeholder'=>'Optional'));}}
			</div>
			<span class='help-block'><small>You can use your real name, of course</small></span>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('phone', 'Phone', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-phone"></i></span>
			{{  Form::text('phone', null, array('class'=>'required', 'placeholder'=>'XXX-XXX-XXXX'));}}
			</div>
			<span class='help-block'><small>A number where we can reach you if we need to</small></span>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('manuscript_title', 'Manuscript title', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-font"></i></span>
			{{  Form::text('manuscript_title', null, array('class'=>'required'));}}
			</div>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('manuscript', 'Manuscript', array('class' => 'control-label')); }}
			<div class="controls">
			<span class="btn btn-default fileinput-button"> <span><i class="icon-plus icon-white"></i> Choose manuscript...</span>
			{{ Form::file('manuscript') }}
			</span>
			</div>
			</div>
			
			<div class="control-group">
			{{ Form::label('cover_letter', 'Cover letter/comments', array('class' => 'control-label')); }}
			<div class="controls">
			{{ Form::textarea('cover_letter', null, array('rows'=>'6','class'=>'input-xxlarge required')); }}
			<span class='help-inline'></span>
			</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="optionsCheckbox"></label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" class='required' name="remember" id="remember" value="1">
						I hereby certify that I am the copyright holder for the manuscript I am submitting
					</label>
				</div>
			</div>
			
			<hr>
			
			<div class="control-group">
			<div class="controls">
			<button class="btn btn-primary" onclick='submitManuscript();return false;'>Submit Manuscript</button>
			</div>
			</div>
		    
			{{ Form::close() }}

		    
		</div> <!-- /span9 primary column -->
	
		@include('users/dashboard/partials/sidemenu')
	</div>
</div>


<div class="modal hide fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Processing...</h3>
			</div>
			<div class="modal-body">
				<div class="progress progress-striped active">
					<div class="bar" style="width: 100%;">
					</div>
				</div>
			</div>
		</div>
	</div>
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
	$('#pleaseWaitDialog').on('shown', function () {
		document.bookform.submit();
	});
});
function submitManuscript(){
	$('#pleaseWaitDialog').modal();
	return false;
}
</script>
@stop