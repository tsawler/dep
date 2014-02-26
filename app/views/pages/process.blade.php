@extends('layout')

@section('browser-title')
The Process: The Dog-Eared Press
@stop

@section('meta')
<meta name="description" content="The process of submitting a manuscript to the Dog-Eared Press" />
@stop


@section('content')

<div class="container">
	<h3 class="short_headline" style="text-transform: none;"><span>The Process</span></h3>
    <div id="rootwizard">
    	<div class="navbar text-center">
			<div class="navbar-inner" 
				style='width: 70%;margin: 0 auto; border: 0; outline: none; background: transparent; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none;'>
				<div class="container">
					<ul  style="margin: 0 auto;">
					    <li><a href="#tab1" data-toggle="tab">Step One</a></li>
					    <li><a href="#tab2" data-toggle="tab">Step Two</a></li>
					    <li><a href="#tab3" data-toggle="tab">Step Three</a></li>
					    <li><a href="#tab4" data-toggle="tab">Step Four</a></li>
					    <li><a href="#tab5" data-toggle="tab">Step Five</a></li>
					    <li><a href="#tab6" data-toggle="tab">Step Six</a></li>
					    <li><a href="#tab7" data-toggle="tab">Step Seven</a></li>
					</ul>
				</div>
			</div>
		</div>
    <div class="tab-content">
    <div class="tab-pane" id="tab1">
    <h2>Step One</h2>
    <p>First, review our <a href="/guidelines">submission guidelines</a> to see what kinds of manuscripts we are interested in. Think carefully
    about the kind of manuscript you have, and if it is a good fit with the kinds of stories that interest us. If, for example, you
    have written a paranormal romance, there are many other publishers out there who are probably a better fit. If, however, you have
    an interesting urban fantasy story, we definitely want to have a look at it.</p>
    </div>
    <div class="tab-pane" id="tab2">
    <h3>Step Two</h3>
    <p>You'll need to create an account with us. All we want is your name, email address and a password. Don't worry&mdash;we'll protect
    your email, and never share it with anyone else. So <a href="/users/register">create an account</a> on our system, 
    <a href="/users/login">log in</a>, and then <a href="/submit/index">submit a manuscript</a>.</p>
    </div>
    <div class="tab-pane" id="tab3">
    <h3>Step Three</h3>
    <p>Once your manuscript is received, we will send you an email letting you know that we have it. Copies of your manuscript are 
    forwarded to our editorial team. Each member of that team will give it a thorough read, and then prepare an evaluation. 
    Once this is complete, the editors will share their findings with one another, and a response will be sent back to you 
    with one of four possible outcomes:</p>
    <ol>
    <li>Your manuscript is accepted as submitted.</li>
    <li>Your manuscript is conditionally accepted, but we would like to see some modifications to it (you&#39;ll have a report 
    outlining those changes).</li>
    <li>Your manuscript is strong enough to warrant going further, but we require significant changes before we can accept it 
    (again, you&#39;ll have&nbsp; a report outlining our suggestions).</li>
    <li>Your manuscript is not a good fit for our press.</li>
    </ol>
    <p>You will be able to track the progress of your submission at any time by visiting your account&#39;s 
    <a href="/users/dashboard">dashboard</a>, and we promise that we won&#39;t keep you waiting for months before you have a decision.</p>
    </div>
    <div class="tab-pane" id="tab4">
    <h3>Step Four</h3>
    <p>Once we have a clean, agreed upon version of your manuscript, we go into the editorial process. You will be assigned an 
    editor, who will work with you improving the quality of your manuscript. It will be checked for typographical, grammatical, 
    and stylistic problems, and we'll work together to make your document as professional, well-written and enjoyable to 
    read as it can be. <strong>This will take a few months</strong>, but we'll never let your manuscript languish in someone's "to do" file.</p>
    </div>
    <div class="tab-pane" id="tab5">
    <h3>Step Five</h3>
    <p>We'll work with you to develop cover art for your document (and yes, you have a great deal of say in this decision!). 
    Working with professional designers, we'll come up with a design that works for you, and that works for us.</p>
    </div>
    <div class="tab-pane" id="tab6">
    <h3>Step Six</h3>
    <p>Once the manuscript  and artwork are ready to go, we'll create e-book versions for the most popular readers&mdash;the Kindle, 
    Kobo, iOS devices like the iPad, and so forth. You'll get a chance to review and approve each version before we go any further.</p>
    </div>
    <div class="tab-pane" id="tab7">
    <h3>Step Seven</h3>
    <p>We'll get your book into our online catalogue, and into the most popular and important online catalogues of other eBook retailers, 
    including Amazon, Kobo, and the iBookstore. We'll also promote your book online, through social media, and at conferences and shows.</p>
    </div>
   
    <!--
    <ul class="pager wizard">
    <li class="previous first" style="display:none;"><a href="#">First</a></li>
    <li class="previous"><a href="#">Previous</a></li>
    <li class="next last" style="display:none;"><a href="#">Last</a></li>
    <li class="next"><a href="#">Next</a></li>
    </ul>
    -->
	    <div style="float:right">
		<input type='button' class='btn button-next' name='next' value='Next' />
		</div>
		<div style="float:left">
		<input type='button' class='btn button-previous' name='previous' value='Previous' />
		</div>
    </div>	
    </div>

<p>&nbsp;</p>	

</div>
@stop

@section('bottom-js')
<script>
    $(document).ready(function() {
    $('#rootwizard').bootstrapWizard({'nextSelector': '.button-next', 'previousSelector': '.button-previous'});
    });
</script>
@stop