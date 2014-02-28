@extends('email-layout')

@section('title')
Welcome to The Dog-Eared Press
@stop



@section('content')
Message from {{ $users_name }}:<br /><br />
<p>Name: {{ $users_name }}</p>
<p>Email: {{ $email }}</p>
<p>{{ $the_message }}</p>

@stop