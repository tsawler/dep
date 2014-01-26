@extends('email-layout')

@section('browser-title')
The Dog Eared Press
@stop



@section('email-content')
Dear {{ $users_name }}:<br /><br />
<p>Thanks for submitting your manuscript entitled <em>{{ $manuscript_title }}</em>. After we have had a chance to review it, we'll be in touch.</p>

<p>Thanks for considering the Dog Eared Press!</p>
@stop