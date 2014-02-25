@extends('email-layout')

@section('browser-title')
The Dog-Eared Press
@stop



@section('email-content')
Message from {{ $users_name }}:<br /><br />
<p>Name: {{ $users_name }}</p>
<p>Email: {{ $email }}</p>
<p>{{ $the_message }}</p>

@stop