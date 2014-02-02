@extends('email-layout')

@section('browser-title')
The Dog-Eared Press
@stop



@section('email-content')
Dear {{ $users_name }}:<br /><br />
<p>Thanks for registering, and Welcome to the Dog-Eared Press.</p>
<p>In order to complete your registration, please active your account by clicking on the following link:</p>
<p><a href="http://www.dogearedpress.ca/verifyaccount?key={{ $token }}">Click here to activate your account</a></p>
@stop