<?php
Event::listen('auth.login', function($user)
{
	session_start();
    $_SESSION['KCFINDER']['disabled'] = false;
});