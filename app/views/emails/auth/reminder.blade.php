@extends('email-layout')

@section('title')
The Dog-Eared Press
@stop

@section('content')
		<h2>Password Reset</h2>
		<hr>
		<p>
		We recently received a request to reset your password on <a href="http://www.dogearedpress.ca">www.dogearedpress.ca</a>. If you did not make
		this request, simply ignore this email, and nothing will change. If you did make this request, click on the link
		below to reset your password.
		</p>
		<a href='{{ URL::to('password/reset', array($token)) }}' class='btn btn-primary'>Reset password</a>
		</p>
		<p>
		Please note that this link is only active for sixty minutes.
		</p>
@stop