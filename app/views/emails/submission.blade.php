@extends('email-layout')

@section('browser-title')
The Dog-Eared Press
@stop



@section('email-content')
A manuscript has been submitted.
@stop


@section('email-content')
A manuscript has been submitted.<br />
User name: {{ $users_name }}:<br /><br />
Manuscript: {{ $manuscript_title }}<br />
@stop