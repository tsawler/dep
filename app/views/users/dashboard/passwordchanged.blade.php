@extends('layout')

@section('browser-title')
Password Change: The Dog Eared Press
@stop

@section('content')
<div class="row-fluid reverse-order"> 
	<div class="span12">
	 	@if(Session::has('message'))
			<div id="editmsg" class='alert alert-success'>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('message') }}
			</div>
		@endif
	</div>
</div>



	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			<h3 class="short_headline" style="text-transform: none;"><span>Password Changed</span></h3>
			
			
			Your password has been changed.
		    
		</div> <!-- /span9 primary column -->
	
		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li><a href='/users/dashboard'>Dashboard</a></li>
						<li><a href='/users/account'>Your Account</a></li>
						<li><a href='/users/password'><strong>Change Password</strong></a></li>
						<li><a href="/users/author">Author Details</a></li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
	</div>
@stop