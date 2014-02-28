@extends('email-layout')

@section('title')
The Dog-Eared Press
@stop


@section('content')
A manuscript has been submitted.<br />
User name: {{ $users_name }}:<br /><br />
Manuscript: {{ $manuscript_title }}<br />
@stop