@extends('layout')

@section('browser-title')
Frequently Asked Questions: The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="FAQs for the Dog-Eared Press" />
@stop


@section('content')

<div class="container">
	<h3 class="short_headline" style="text-transform: none;"><span>Frequently Asked Questions</span></h3>

@if ((Auth::check()) && ((Auth::user()->access_level == 3) && (Auth::user()->roles->contains(5))))
	<ul class="s-accordion faq fancy">
		@foreach($faqs as $faq)
			<li class="s-wrap">
				{{ Form::open(array('style' => 'display: inline', 'url' => 'faq/edit', 'name' => 'faqform_'.$faq->id, 'id' => 'faqform_'.$faq->id)) }}
					<h4 class="trigger">
						<a href="#">
							<span class='editable' id="labeldata_{{$faq->id }}">
								{{ $faq->label }}<i class="icon-plus-sign"></i>
							</span>
						</a>
						</h4>
					<div class="s-content">
						<strong><span class='editable' id="questiondata_{{$faq->id }}">{{ $faq->question }}</strong><br>
							<article id="answerdata_{{ $faq->id }}" class='editable'>{{ $faq->answer }}</article>
						</p>
						<article class="admin-hidden">
						<a class="btn btn-primary" href="#!" onclick="saveEditedFaq({{ $faq->id }})">Save</a>
						<a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
						&nbsp;&nbsp;&nbsp;
					</article>
					</div>
					<input type="hidden" name="faq_id" value="{{ $faq->id }}">
					<input type="hidden" name="thelabeldata_{{ $faq->id }}" id="thelabeldata_{{ $faq->id }}">
					<input type="hidden" name="thequestiondata_{{ $faq->id }}" id="thequestiondata_{{ $faq->id }}">
					<input type="hidden" name="theanswerdata_{{ $faq->id }}" id="theanswerdata_{{ $faq->id }}">
				{{ Form::close() }}
			</li>
		@endforeach
	</ul>
@else
<ul class="s-accordion faq fancy">
	@foreach($faqs as $faq)
		<li class="s-wrap">
			<h4 class="trigger"><a href="#">{{ $faq->label }}<i class="icon-plus-sign"></i></a></h4>
			<div class="s-content">
				<p><strong>Answer:</strong><br>
				{{ $faq->answer }}
				</p>
			</div>
		</li>
	@endforeach
</ul>
@endif

<p>&nbsp;</p>	
<span id="theeditmsg" class="hidden">&nbsp;</span>    
</div>
@stop

@section('bottom-js')
<script>
    $(document).ready(function() {

    });
</script>
@stop