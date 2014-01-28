@extends('layout')

@section('browser-title')
Submit a Manuscript: The Dog Eared Press
@stop

@section('meta')
<meta name="description" content="Submit a manuscript to the Dog Eared Press, an independent publisher of fantasy eBooks." />
@stop


@section('content')

<div class="row-fluid reverse-order"> 
	<div class="span12">
		<h3 class="short_headline" style="text-transform: none;"><span>Submit a Manuscript</span></h3>
		
		@if(count($errors) > 0)
		<div class="alert alert-error">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
		@endif
		
		<p>Thanks for considering the Dog Eared Press as a home for your manuscript. We'll need to collect some
		basic information about you and your manuscript in order to proceed. Please ensure that you have <a href='/guidelines'>reviewed our 
		submission guidelines</a> first.</p>
		
		{{ Form::open(array(
			'url' => 'submit/create', 
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
		<span class="btn btn-default fileinput-button"> <span><i class="icon-plus icon-white"></i> Upload manuscript...</span>
		{{ Form::file('manuscript') }}
		</span>
		</div>
		</div>
		
		<div class="control-group">
		<div class="controls">
		<hr>
	    {{ Form::submit('Submit Manuscript', array('class' => 'btn btn-primary')); }}
	    </div>
		</div>
	    
		{{ Form::close() }}
	</div>
	
</div>
<!-- end row-fluid-->
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
});
</script>
@stop