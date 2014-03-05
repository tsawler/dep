<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	$protected = array(	
						'users/login',
						'users/signin',
						'users/tfa',
						'users/checktfa',
						'users/register',
						'users/create',
						'users/logout',
						'users/dashboard',
						'users/account',
						'users/author',
						'users/password',
						'users/security',
						'password/remind',
						'password/reset',
						'users/testcode',
						'users/code',
						'submit/index',
						'submit/create',
						'users/submit'
						);
	$www = false;
	$isadmin = false;
	
	if (strpos(Request::url(),'www') !== false) 
		$www = true;
	
	$where = Request::path();
	
	if (substr($where, 0,6) == "/admin")
		$isadmin = true;
	
	$environment = App::environment();
	
	if ($environment != 'local'){
		if( ! Request::secure()) {
			if (in_array($where, $protected)) {
				return Redirect::to(Config::get('app.secureurl') . Request::getRequestUri());
			}
			if ($www == false){
				return Redirect::to(Config::get('app.url') . Request::getRequestUri());
			}
		} else {
			if ((!(in_array($where, $protected))) && ($isAdmin == false)) {
				return Redirect::to(Config::get('app.url') . Request::getRequestUri());
			}
		}
	}
	
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('users/login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*
|--------------------------------------------------------------------------
| Force SSL Filter
|--------------------------------------------------------------------------
|
| Force certain routes to be SSL only in production
|
*/

Route::filter('force.ssl', function()
{
 	if( ! Request::secure() && App::environment() !== 'local')
 	{
	 	return Redirect::to(Config::get('app.secureurl') . Request::getRequestUri());
	 }
});

/*
|--------------------------------------------------------------------------
| Force Non-SSL Filter
|--------------------------------------------------------------------------
|
| Force certain routes to be non-SSL only in production
|
*/

Route::filter('force.nonssl', function()
{
	if( Request::secure() && App::environment() !== 'local')
 	{
	 	return Redirect::to(Config::get('app.url') . Request::getRequestUri());
	 }
});

/* View Composers */