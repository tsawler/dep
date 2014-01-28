<?php
/*
|------------------------------------------------------------------------------------
|
|  Home page
|
|------------------------------------------------------------------------------------
*/

Route::any('/','PageController@showHome');

/*
|------------------------------------------------------------------------------------
|
| Page Routes
|
|------------------------------------------------------------------------------------
*/

Route::get('{pagename?}','PageController@showPage');

Route::post('/page/edit','PageController@editPage');

Route::get('/page/create', array('before' => 'auth', function()
	{
		return View::make('pages.createpage');
	}));

/*
|------------------------------------------------------------------------------------
|
| User/Account Routes
|
|------------------------------------------------------------------------------------
*/
Route::controller('/users', 'UserController');

Route::get('/verifyaccount','UsersPendingController@validateUser');

Route::controller('password', 'RemindersController');

Route::controller('/submit', 'SubmitController');

/*
|------------------------------------------------------------------------------------
|
| Blog Routes
|
|------------------------------------------------------------------------------------
*/
Route::controller('/post', 'BlogController');
