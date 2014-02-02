@extends('layout')

@section('browser-title')
Password Change: The Dog Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Security</span></h3>
			
			 <h3>Two-Step Authentication</h3>
		    <p>
		    Two-step Authentication is an optional but highly recommended security feature that adds an extra layer of protection to your account. 
		    Once you enable two-step, Authentication, you will be asked to enter a six-digit security code in addition to your password 
		    whenever you sign in.</p>
		    
		    <p>You will get the six digit code using an application installed on your mobile phone. The numeric code is 
		    regenerated every thirty seconds, making your account very secure. Which application you use
		    depends on what kind of device you have:</p>
			
		    <ul>
		    <li><a href="http://support.google.com/accounts/bin/answer.py?hl=en&answer=1066447" target="_blank">Google Authenticator</a> (Android/iPhone/BlackBerry)</li>
		    <li><a href="http://guide.duosecurity.com/third-party-accounts" target="_blank">Duo Mobile</a> (Android/iPhone)</li>
		    <li><a href="http://www.amazon.com/gp/product/B0061MU68M" target="_blank">Amazon AWS MFA</a> (Android)</li>
		    <li><a href="http://www.windowsphone.com/en-US/apps/021dd79f-0598-e011-986b-78e7d1fa76f8">Authenticator</a> (Windows Phone)</li>
		    </ul>
		    
		    <p>
			<strong>Install the application on your phone before you enable two-step Authentication</strong>. Once it is installed, 
			enable this feature on your account, and then scan the QR code which will be displayed on this page.</p>
			
			<p>Most apps will generate security codes even when cellular/data service is not available, which is useful when traveling 
			or where coverage is unreliable.</p>
			
			{{ Form::model($user, array(
										'class' => 'form-horizontal', 
										'name' => 'bookform', 'id' => 'bookform',
										'url' => array('users/security', $user->id )
										) 
						   )
			}}
			    <div class="control-group">
				{{  Form::label('use_tfa', 'Use 2-Step Auth', array('class' => 'control-label')); }}
				<div class="controls">
				<div class="input-prepend"> <span class="add-on">?</span>
				{{ Form::select('use_tfa', array(
					'1' => 'Yes',
					'0' => 'No')) }}
				</div>
				</div>
			    </div>

@if(Auth::user()->use_tfa == 1)
			    <div id="qr" class="control-group">
@else
				<div id="qr" class="control-group hidden">
@endif
			    <div class="controls">
			    <img src="{{ $qrCodeUrl }}"><br><br>
			    </div>
			    </div>
			    
			    <hr>
			    
			    <div class="control-group">
			    <div class="controls">
			    {{ Form::submit('Update', array('class' => 'btn btn-primary'));}}
			    </div>
			    </div>
			    
		    {{ Form::close() }}
		   
		    
		</div> <!-- /span9 primary column -->
	
		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li><a href='/users/dashboard'>Dashboard</a></li>
						<li><a href='/users/account'>Your Account</a></li>
						<li><a href="/users/author">Author Details</a></li>
						<li><a href='/users/password'>Change Password</a></li>
						<li><a href="/users/security"><strong>Security</strong></a></li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
	</div>
</div>
@stop