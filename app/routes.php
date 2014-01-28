<?php
/*
|------------------------------------------------------------------------------------
|
|  General Routes
|
|------------------------------------------------------------------------------------
*/

Route::any('/', function()
	{
		return View::make('pages.home');
	});

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
		return View::make('createpage');
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

Route::get('/authors', 'AuthorController@listAuthors');

Route::controller('/submit', 'SubmitController');

/*
|------------------------------------------------------------------------------------
|
| Blog Routes
|
|------------------------------------------------------------------------------------
*/
Route::controller('/post', 'BlogController');
