<?php
Event::listen('auth.login', function($user)
{
	ini_set('session.cookie_domain', '.dogearedpress.ca' );
	ini_set("session.cookie_lifetime","86400"); //a day
	session_start();
    $_SESSION['KCFINDER']['disabled'] = false;
});