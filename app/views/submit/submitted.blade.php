@extends('layout')

@section('browser-title')
Manuscript Recieved: The Dog Eared Press
@stop

@section('meta')
<meta name="description" content="Submit a manuscript to the Dog Eared Press, an independent publisher of fantasy eBooks." />
@stop


@section('content')

<div class="container">
<div class="span12">
		<h3 class="short_headline" style="text-transform: none;"><span>Submit a Manuscript</span></h3>
		
		<p>Thanks, {{ Auth::user()->first_name; }}. We have received your manuscript, and you should receive a notification email at 
			{{ Auth::user()->email; }} shortly.</p>
			
		<p>Once we have reviewed your submission, we'll be in touch.</p>
		
		<p>Thanks for considering the Dog Eared Press!</p>
		
		
	</div>
	
</div>
<!-- end row-fluid-->
@stop
